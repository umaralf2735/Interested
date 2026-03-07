<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Online Layanan Publik</title>
    <!-- Modern Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --secondary: #10B981;
            --bg: #F3F4F6;
            --card-bg: #FFFFFF;
            --text-dark: #111827;
            --text-gray: #6B7280;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
        }

        header {
            background: linear-gradient(135deg, var(--primary), #818CF8);
            color: white;
            padding: 1.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
        }

        header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        header p {
            font-size: 0.95rem;
            opacity: 0.9;
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
            border-radius: 1rem;
            padding: 2.5rem;
            text-align: center;
            box-shadow: var(--shadow-lg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-top: 5px solid var(--secondary);
        }

        .live-queue h2 {
            font-size: 1.25rem;
            color: var(--text-gray);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .current-number {
            font-size: 5rem;
            font-weight: 700;
            color: var(--primary);
            margin: 1rem 0;
            line-height: 1;
            transition: all 0.3s ease;
        }
        
        .pulse {
            animation: pulse-animation 2s infinite;
        }

        @keyframes pulse-animation {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .service-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* SERVICES LIST */
        .services-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .service-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
            border-left: 4px solid transparent;
        }

        .service-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            border-left-color: var(--primary);
        }

        .service-info h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .service-info p {
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .btn-take {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-take:hover {
            background-color: var(--primary-hover);
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
            z-index: 50;
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-content {
            background: var(--card-bg);
            padding: 3rem;
            border-radius: 1rem;
            text-align: center;
            box-shadow: var(--shadow-lg);
            transform: translateY(20px);
            transition: all 0.3s ease;
            max-width: 400px;
            width: 90%;
        }
        
        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }
        
        .modal-content h3 {
            color: var(--text-gray);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .modal-ticket {
            font-size: 4rem;
            font-weight: 700;
            color: var(--primary);
            margin: 1rem 0;
        }
        
        .btn-close {
            margin-top: 1.5rem;
            background-color: var(--bg);
            color: var(--text-dark);
            border: 1px solid #E5E7EB;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-close:hover {
            background-color: #E5E7EB;
        }
        
        /* Footer */
        footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--text-gray);
            font-size: 0.875rem;
            border-top: 1px solid #E5E7EB;
        }
        
        .admin-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.5rem;
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
            <p id="modalServiceName">Pendaftaran</p>
            <p style="margin-top: 0.5rem; font-size: 0.85rem; color: #6B7280;">Harap tunggu nomor Anda dipanggil.</p>
            <button class="btn-close" onclick="closeModal()">Tutup</button>
        </div>
    </div>

    <footer>
        &copy; 2026 Antrian Publik. Hak Cipta Dilindungi. <a href="{{ route('admin') }}" class="admin-link">Login Admin</a>
    </footer>

    <script>
        const baseUrl = "{{ url('/') }}";
        let lastCalledTicket = null;
        
        // Take a queue ticket
        function takeQueue(serviceId, serviceName) {
            fetch(`${baseUrl}/api/queue/take`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
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
                alert('Terjadi kesalahan jaringan.');
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
        
        // Polling to get live active queue
        function fetchStatus() {
            fetch(`${baseUrl}/api/queue/status`)
                .then(res => res.json())
                .then(data => {
                    const activeQueueNumberEl = document.getElementById('activeQueueNumber');
                    const activeServiceEl = document.getElementById('activeService');
                    
                    if (data.active) {
                        // Play sound if there is a new called ticket
                        if(lastCalledTicket !== data.active.queue_number) {
                            lastCalledTicket = data.active.queue_number;
                            activeQueueNumberEl.innerText = data.active.queue_number;
                            activeServiceEl.innerText = data.active.service.name;
                            
                            // Visual feedback
                            activeQueueNumberEl.classList.remove('pulse');
                            void activeQueueNumberEl.offsetWidth; // trigger reflow
                            activeQueueNumberEl.classList.add('pulse');
                            
                            // Play sound
                            document.getElementById('bellSound').play().catch(e => console.log('Autoplay prevented'));
                        }
                    } else {
                        activeQueueNumberEl.innerText = '---';
                        activeServiceEl.innerText = 'Menunggu Panggilan';
                    }
                })
                .catch(err => console.error(err));
        }
        
        // Init
        fetchStatus();
        setInterval(fetchStatus, 3000); // Poll every 3 seconds
    </script>
</body>
</html>
