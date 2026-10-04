// Italian text-to-speech (uses the browser's built-in voices).
window.speakItalian = (text) => {
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
