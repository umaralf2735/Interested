<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Antrian Online</title>
    <!-- Modern Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --secondary: #10B981;
            --danger: #EF4444;
            --danger-hover: #DC2626;
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
            background: #1F2937;
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-md);
        }

        header h1 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 1px solid rgba(255,255,255,0.5);
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        
        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }

        main {
            flex: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 1rem;
            width: 100%;
        }

        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-header h2 {
            font-size: 1.8rem;
            color: var(--text-dark);
        }

        .dashboard-header p {
            color: var(--text-gray);
            margin-top: 0.5rem;
        }

        /* GRID */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .grid-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .admin-card {
            background: var(--card-bg);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            border-top: 4px solid var(--primary);
            display: flex;
            flex-direction: column;
        }

        .admin-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .admin-card p {
            color: var(--text-gray);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .queue-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #F9FAFB;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-gray);
            font-weight: 600;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .btn-call {
            background-color: var(--secondary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            width: 100%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }

        .btn-call:hover {
            background-color: #059669; /* Darker emerald */
        }
        
        .btn-call:disabled {
            background-color: #D1D5DB;
            cursor: not-allowed;
            color: #9CA3AF;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--text-gray);
            font-size: 0.875rem;
            border-top: 1px solid #E5E7EB;
        }
    </style>
</head>
<body>

    <header>
        <h1>Admin Control Panel</h1>
        <a href="{{ route('home') }}" class="btn-outline">&larr; Kembali ke Publik</a>
    </header>

    <main>
        <div class="dashboard-header">
            <h2>Manajemen Antrian</h2>
            <p>Panggil nomor antrian berikutnya untuk setiap layanan.</p>
        </div>

        <div class="grid-container" id="adminGrid">
            <!-- Rendered by JS -->
            <div style="text-align:center; grid-column: 1 / -1; padding: 2rem;">
                <p>Memuat data layanan...</p>
            </div>
        </div>
    </main>

    <footer>
        &copy; 2026 Antrian Publik. Hak Cipta Dilindungi.
    </footer>

    <script>
        const baseUrl = "{{ url('/') }}";
        
        function callQueue(serviceId) {
            const btn = document.getElementById(`btn-call-${serviceId}`);
            if(btn) btn.disabled = true;
            
            fetch(`${baseUrl}/api/queue/call`, {
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
                    alert(`Berhasil: ${data.message}`);
                    fetchDashboard();
                } else {
                    alert(`Info: ${data.message}`);
                    if(btn) btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
                if(btn) btn.disabled = false;
            });
        }
        
        function fetchDashboard() {
            fetch(`${baseUrl}/api/queue/status`)
                .then(res => res.json())
                .then(data => {
                    const grid = document.getElementById('adminGrid');
                    
                    if(data.summary && data.summary.length > 0) {
                        grid.innerHTML = '';
                        data.summary.forEach(service => {
                            const hasPending = service.pending_count > 0;
                            const btnHtml = hasPending 
                                ? `<button id="btn-call-${service.id}" class="btn-call" onclick="callQueue(${service.id})">Panggil Antrian Berikutnya</button>`
                                : `<button id="btn-call-${service.id}" class="btn-call" disabled>Tidak ada antrian</button>`;
                                
                            const html = `
                                <div class="admin-card">
                                    <h3>${service.name}</h3>
                                    <p>Kode: ${service.code}</p>
                                    
                                    <div class="queue-stats">
                                        <div class="stat-item">
                                            <div class="stat-label">Menunggu</div>
                                            <div class="stat-value" style="color: ${hasPending ? '#EF4444' : '#10B981'}">${service.pending_count}</div>
                                        </div>
                                    </div>
                                    
                                    ${btnHtml}
                                </div>
                            `;
                            grid.innerHTML += html;
                        });
                    } else {
                        grid.innerHTML = `
                            <div style="text-align:center; grid-column: 1 / -1; padding: 3rem; background: white; border-radius: 1rem; box-shadow: var(--shadow-md);">
                                <h3>Belum ada Layanan</h3>
                                <p style="color: #6B7280; margin-top: 0.5rem;">Silakan tambahkan data layanan ke tabel \`services\` di database.</p>
                            </div>
                        `;
                    }
                })
                .catch(err => console.error(err));
        }
        
        // Init
        fetchDashboard();
        setInterval(fetchDashboard, 5000); // Admin can poll every 5 seconds to get refresh counts
    </script>
</body>
</html>
