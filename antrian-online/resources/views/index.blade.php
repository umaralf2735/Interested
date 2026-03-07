<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Antrian Online Layanan Publik</title>
    <!-- Modern Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366F1; /* Indigo 500 */
            --primary-hover: #4F46E5;
            --secondary: #10B981; /* Emerald 500 */
            --bg: #0F172A; /* Slate 900 */
            --bg-accent: #020617; /* Slate 950 */
            --card-bg: #1E293B; /* Slate 800 */
            --card-hover: #334155; /* Slate 700 */
            --text-dark: #F8FAFC; /* Slate 50 */
            --text-gray: #94A3B8; /* Slate 400 */
            --border: #334155;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
            --shadow-glow: 0 0 20px rgba(99, 102, 241, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: radial-gradient(circle at top, var(--bg-accent) 0%, var(--bg) 100%);
        }

        header {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(10px);
            color: white;
            padding: 1.5rem 2rem;
            text-align: center;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, #818CF8, #C084FC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        header p {
            font-size: 0.95rem;
            color: var(--text-gray);
            margin-top: 0.5rem;
        }

        main {
            flex: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 1rem;
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            width: 100%;
        }

        @media (min-width: 768px) {
            main {
                grid-template-columns: 1fr 1.5fr;
            }
        }

        /* LIVE QUEUE DISPLAY */
        .live-queue {
            background-color: var(--card-bg);
            border-radius: 1.25rem;
            padding: 2.5rem;
            text-align: center;
            box-shadow: var(--shadow-lg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .live-queue::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary), var(--primary));
        }

        .live-queue h2 {
            font-size: 1.25rem;
            color: var(--text-gray);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .current-number {
            font-size: 5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin: 1rem 0;
            line-height: 1;
            transition: all 0.3s ease;
            text-shadow: var(--shadow-glow);
        }
        
        .pulse {
            animation: pulse-animation 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse-animation {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .7; transform: scale(1.05); }
        }

        .service-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* SERVICES LIST */
        .services-container {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .service-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .service-card:hover {
            transform: translateY(-4px);
            background-color: var(--card-hover);
            border-color: var(--primary);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.2);
        }

        .service-info h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--text-dark);
        }

        .service-info p {
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .btn-take {
            background: linear-gradient(135deg, var(--primary), #818CF8);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4);
        }

        .btn-take:hover {
            opacity: 0.9;
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
            z-index: 50;
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-content {
            background: var(--card-bg);
            padding: 3rem;
            border-radius: 1.5rem;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            border: 1px solid var(--border);
            transform: translateY(20px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            max-width: 400px;
            width: 90%;
        }
        
        .modal-overlay.active .modal-content {
            transform: translateY(0) scale(1);
        }
        
        .modal-content h3 {
            color: var(--text-gray);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .modal-ticket {
            font-size: 4.5rem;
            font-weight: 800;
            color: transparent;
            background: linear-gradient(135deg, #10B981, #34D399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 1rem 0;
            text-shadow: 0px 4px 10px rgba(16, 185, 129, 0.2);
        }
        
        .btn-close {
            margin-top: 2rem;
            background-color: transparent;
            color: var(--text-dark);
            border: 1px solid var(--border);
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-close:hover {
            background-color: var(--card-hover);
            border-color: var(--text-gray);
        }
        
        footer {
            text-align: center;
            padding: 2rem;
            color: var(--text-gray);
            font-size: 0.875rem;
            border-top: 1px solid var(--border);
            background: rgba(30, 41, 59, 0.5);
        }
        
        .admin-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.5rem;
            transition: color 0.2s;
        }

        .admin-link:hover {
            color: #818CF8;
        }
    </style>
</head>
<body>

    <header>
        <h1>Antrian Online Layanan Publik</h1>
        <p>Ambil tiket antrian Anda dengan mudah, cepat, dan transparan.</p>
    </header>

    <main>
        <!-- Live Active Queue -->
        <div class="live-queue">
            <h2>Antrian Berjalan</h2>
            <div class="current-number" id="activeQueueNumber">---</div>
            <div class="service-name" id="activeService">Menunggu Panggilan</div>
            
            <audio id="bellSound" src="https://assets.mixkit.co/sfx/preview/mixkit-software-interface-start-2574.mp3" preload="auto"></audio>
        </div>

        <!-- Services Selection -->
        <div class="services-container">
            <h2 class="section-title">Pilih Layanan</h2>
            
            @if($services->count() > 0)
                @foreach($services as $service)
                <div class="service-card" onclick="takeQueue({{ $service->id }}, '{{ $service->name }}')">
                    <div class="service-info">
                        <h3>{{ $service->name }}</h3>
                        <p>{{ $service->description ?? 'Layanan umum' }}</p>
                    </div>
                    <button class="btn-take">Ambil Tiket</button>
                </div>
                @endforeach
            @else
                <div class="service-card">
                    <div class="service-info">
                        <h3>Belum ada layanan</h3>
                        <p>Administrator belum menambahkan layanan apapun.</p>
                    </div>
                </div>
            @endif
        </div>
    </main>
    
    <!-- Modal for Ticket Success -->
    <div class="modal-overlay" id="ticketModal">
        <div class="modal-content">
            <h3>Nomor Antrian Anda</h3>
            <div class="modal-ticket" id="modalTicketNumber">A001</div>
            <p id="modalServiceName" style="color: var(--text-dark); font-weight: 600; font-size: 1.1rem;">Pendaftaran</p>
            <p style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--text-gray);">Harap tunggu nomor Anda dipanggil.</p>
            <button class="btn-close" onclick="closeModal()">Tutup</button>
        </div>
    </div>

    <footer>
        &copy; 2026 Antrian Publik. Hak Cipta Dilindungi. <a href="{{ route('admin') }}" class="admin-link">Kelola Antrian (Admin)</a>
    </footer>

    <script>
        const baseUrl = "{{ url('/') }}";
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let lastCalledTicket = null;
        
        function takeQueue(serviceId, serviceName) {
            fetch(`${baseUrl}/queue/take`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ service_id: serviceId })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    showModal(data.ticket.queue_number, serviceName);
                    fetchStatus(); // Refresh fast
                } else {
                    alert('Gagal mengambil antrian.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan jaringan. Cek console log.');
            });
        }
        
        function showModal(ticketNumber, serviceName) {
            document.getElementById('modalTicketNumber').innerText = ticketNumber;
            document.getElementById('modalServiceName').innerText = serviceName;
            document.getElementById('ticketModal').classList.add('active');
        }
        
        function closeModal() {
            document.getElementById('ticketModal').classList.remove('active');
        }
        
        function fetchStatus() {
            fetch(`${baseUrl}/queue/status`)
                .then(res => res.json())
                .then(data => {
                    const activeQueueNumberEl = document.getElementById('activeQueueNumber');
                    const activeServiceEl = document.getElementById('activeService');
                    
                    if (data.active) {
                        if(lastCalledTicket !== data.active.queue_number) {
                            lastCalledTicket = data.active.queue_number;
                            activeQueueNumberEl.innerText = data.active.queue_number;
                            activeServiceEl.innerText = data.active.service.name;
                            
                            activeQueueNumberEl.classList.remove('pulse');
                            void activeQueueNumberEl.offsetWidth; // trigger reflow
                            activeQueueNumberEl.classList.add('pulse');
                            
                            document.getElementById('bellSound').play().catch(e => console.log('Autoplay prevented'));
                        }
                    } else {
                        activeQueueNumberEl.innerText = '---';
                        activeServiceEl.innerText = 'Menunggu Panggilan';
                    }
                })
                .catch(err => console.error(err));
        }
        
        fetchStatus();
        setInterval(fetchStatus, 3000);
    </script>
</body>
</html>
