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

window.speakItalian = (text) => {
    if (!text) return;

    if (currentAudio) {
        currentAudio.pause();
        currentAudio = null;
    }
    if ('speechSynthesis' in window) window.speechSynthesis.cancel();

    const audio = new Audio('/tts?text=' + encodeURIComponent(text));
    currentAudio = audio;

    audio.addEventListener('error', () => browserSpeak(text), { once: true });
    audio.play().catch((err) => {
        // Autoplay restrictions are expected before the first interaction; anything else falls back.
        if (err && err.name !== 'NotAllowedError' && err.name !== 'AbortError') browserSpeak(text);
    });
};

window.autoSpeak = (text) => {
    try {
        if (localStorage.getItem('autoSpeak') === '1') window.speakItalian(text);
    } catch (e) {
        // localStorage may be unavailable
    }
};

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
