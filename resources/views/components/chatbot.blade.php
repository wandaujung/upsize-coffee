
<div id="upsize-chatbot" class="fixed bottom-6 right-6 z-50">
    <div id="chatbot-panel" class="hidden mb-4 w-80 max-w-[calc(100vw-3rem)] overflow-hidden rounded-2xl bg-white shadow-2xl sm:w-96">
        <div class="flex items-center justify-between bg-amber-900 px-4 py-3 text-white">
            <div>
                <h3 class="font-semibold">UpSize Coffee Assistant</h3>
                <p class="text-xs text-amber-100">Ada yang bisa kami bantu?</p>
            </div>
            <button type="button" id="chatbot-close" class="text-2xl" aria-label="Tutup chatbot">&times;</button>
        </div>

        <div id="chatbot-messages" class="flex h-80 flex-col gap-3 overflow-y-auto bg-amber-50 p-4" aria-live="polite">
            <div class="max-w-[85%] self-start rounded-2xl bg-white px-4 py-3 text-sm text-gray-800 shadow-sm">
                Halo! Selamat datang di UpSize Coffee. Mau tanya tentang menu, pemesanan, atau booking?
            </div>
        </div>

        <form id="chatbot-form" class="flex gap-2 border-t border-gray-200 bg-white p-3">
            <input
                id="chatbot-input"
                type="text"
                placeholder="Tulis pertanyaan..."
                maxlength="500"
                autocomplete="off"
                class="min-w-0 flex-1 rounded-xl border border-gray-300 px-3 py-2 text-sm focus:border-amber-700 focus:outline-none"
                required
            >
            <button
                type="submit"
                id="chatbot-send"
                class="rounded-xl bg-amber-900 px-4 py-2 text-sm font-medium text-white hover:bg-amber-800 disabled:cursor-not-allowed disabled:opacity-50"
            >
                Kirim
            </button>
        </form>
    </div>

    <button
        type="button"
        id="chatbot-toggle"
        class="ml-auto flex h-14 w-14 items-center justify-center rounded-full bg-amber-900 text-2xl text-white shadow-xl hover:bg-amber-800"
        aria-label="Buka chatbot"
        aria-expanded="false"
    >
        &#9749;
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const panel = document.getElementById('chatbot-panel');
    const toggle = document.getElementById('chatbot-toggle');
    const close = document.getElementById('chatbot-close');
    const form = document.getElementById('chatbot-form');
    const input = document.getElementById('chatbot-input');
    const sendButton = document.getElementById('chatbot-send');
    const messages = document.getElementById('chatbot-messages');

    function addMessage(message, sender) {
        const bubble = document.createElement('div');

        bubble.className = sender === 'user'
            ? 'max-w-[85%] self-end rounded-2xl bg-amber-900 px-4 py-3 text-sm text-white shadow-sm'
            : 'max-w-[85%] self-start rounded-2xl bg-white px-4 py-3 text-sm text-gray-800 shadow-sm';

        bubble.textContent = message;

        messages.appendChild(bubble);
        messages.scrollTop = messages.scrollHeight;

        return bubble;
    }

    toggle.addEventListener('click', function () {
        const isHidden = panel.classList.toggle('hidden');
        toggle.setAttribute('aria-expanded', String(!isHidden));

        if (!isHidden) {
            input.focus();
        }
    });

    close.addEventListener('click', function () {
        panel.classList.add('hidden');
        toggle.setAttribute('aria-expanded', 'false');
    });

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const message = input.value.trim();

        if (!message || sendButton.disabled) {
            return;
        }

        addMessage(message, 'user');

        input.value = '';
        input.disabled = true;
        sendButton.disabled = true;
        sendButton.textContent = '...';

        const loadingMessage = addMessage('Sedang mengetik...', 'bot');

        try {
            const response = await fetch("{{ route('chatbot.send') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    message: message
                })
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 429) {
                    throw new Error('Terlalu banyak pesan. Coba lagi sebentar.');
                }

                throw new Error(data.message || 'Gagal mendapatkan jawaban AI.');
            }

            if (!data.reply) {
                throw new Error('AI belum memberikan jawaban.');
            }

            loadingMessage.textContent = data.reply;
        } catch (error) {
            loadingMessage.textContent = error.message || 'Terjadi kesalahan. Silakan coba lagi.';
        } finally {
            input.disabled = false;
            sendButton.disabled = false;
            sendButton.textContent = 'Kirim';
            input.focus();
            messages.scrollTop = messages.scrollHeight;
        }
    });
});
</script>
