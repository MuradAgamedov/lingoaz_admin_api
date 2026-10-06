// Italian text-to-speech: server-side Piper audio (cached), with the browser voice as a fallback.
let currentAudio = null;

const browserSpeak = (text) => {
    if (!('speechSynthesis' in window) || !text) return;

    const synth = window.speechSynthesis;
    synth.cancel();

    const utterance = new SpeechSynthesisUtterance(String(text));
    utterance.lang = 'it-IT';
    utterance.rate = 0.9;

    const voice = synth.getVoices().find((v) => v.lang.toLowerCase().startsWith('it'));
    if (voice) utterance.voice = voice;

    synth.speak(utterance);
};

const VOICES = ['sara', 'nicola', 'piper'];

const getVoice = () => {
    try {
        const stored = localStorage.getItem('ttsVoice');
        return VOICES.includes(stored) ? stored : 'sara';
    } catch (e) {
        return 'sara';
    }
};

const syncVoiceSelects = () => {
    document.querySelectorAll('[data-tts-voice]').forEach((select) => {
        select.value = getVoice();
    });
};

document.addEventListener('DOMContentLoaded', syncVoiceSelects);
document.addEventListener('livewire:navigated', syncVoiceSelects);

window.speakItalian = (text) => {
    if (!text) return;

    if (currentAudio) {
        currentAudio.pause();
        currentAudio = null;
    }
    if ('speechSynthesis' in window) window.speechSynthesis.cancel();

    const audio = new Audio('/tts?voice=' + getVoice() + '&text=' + encodeURIComponent(text));
    currentAudio = audio;

    audio.addEventListener('error', () => browserSpeak(text), { once: true });
    audio.play().catch((err) => {
        // Autoplay restrictions are expected before the first interaction; anything else falls back.
        if (err && err.name !== 'NotAllowedError' && err.name !== 'AbortError') browserSpeak(text);
    });
};

document.addEventListener('change', (e) => {
    if (e.target && e.target.matches && e.target.matches('[data-tts-voice]')) {
        try {
            localStorage.setItem('ttsVoice', e.target.value);
        } catch (err) {
            // localStorage may be unavailable
        }
        syncVoiceSelects();
        window.speakItalian('Ciao! Come stai?');
    }
});

// Auto-speak is opt-in per game: it starts switched off and is never remembered.
window.__autoSpeak = false;

window.autoSpeak = (text) => {
    if (window.__autoSpeak) window.speakItalian(text);
};

// Audio for the dictionary form: warm the cache when the word is entered, play it after a suggestion.
window.prefetchItalian = (text) => {
    if (!text) return;
    fetch('/tts?voice=' + getVoice() + '&text=' + encodeURIComponent(text), { credentials: 'same-origin' }).catch(() => {});
};

const eventText = (e) => (Array.isArray(e) ? (e[0] && e[0].text) || e[0] : e && e.text) || '';

const registerLivewireAudioEvents = () => {
    if (window.__lingoAudioEvents || !window.Livewire) return;
    window.__lingoAudioEvents = true;
    window.Livewire.on('prefetch-audio', (e) => window.prefetchItalian(eventText(e)));
    window.Livewire.on('speak-word', (e) => window.speakItalian(eventText(e)));
};

registerLivewireAudioEvents();
document.addEventListener('livewire:init', registerLivewireAudioEvents);

// Keyboard shortcuts for the game screen.
if (!window.__lingoKeys) {
    window.__lingoKeys = true;

    document.addEventListener('keydown', (e) => {
        if (e.metaKey || e.ctrlKey || e.altKey) return;

        const target = e.target;
        const typing = target && target.matches && target.matches('input, textarea, select, [contenteditable="true"]');
        if (typing) return;

        const click = (selector, index = 0) => {
            const el = document.querySelectorAll(selector)[index];
            if (el && !el.disabled) {
                e.preventDefault();
                el.click();
                return true;
            }
            return false;
        };

        if (/^[1-9]$/.test(e.key)) {
            click('[data-option]', Number(e.key) - 1);
        } else if (e.key === 'Enter') {
            click('[data-next]') || click('[data-reveal]');
        } else if (e.key === ' ') {
            click('[data-reveal]');
        } else if (e.key === 'ArrowLeft') {
            click('[data-prev]');
        } else if (e.key === 'ArrowRight') {
            click('[data-know]') || click('[data-next]');
        }
    });
}
