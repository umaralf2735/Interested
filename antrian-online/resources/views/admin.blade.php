<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Antrian Online</title>
    <!-- Modern Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366F1; /* Indigo 500 */
            --primary-hover: #4F46E5;
            --secondary: #10B981; /* Emerald 500 */
            --danger: #EF4444; /* Red 500 */
            --danger-hover: #DC2626;
            --bg: #0F172A; /* Slate 900 */
            --card-bg: #1E293B; /* Slate 800 */
            --card-hover: #334155; /* Slate 700 */
            --text-dark: #F8FAFC; /* Slate 50 */
            --text-gray: #94A3B8; /* Slate 400 */
            --border: #334155;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
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
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(10px);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #818CF8, #C084FC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-outline {
            background: transparent;
            color: var(--text-dark);
            border: 1px solid var(--border);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .btn-outline:hover {
            background: var(--card-hover);
        }

        /* Forms in header */
        .logout-form {
            display: inline;
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
            font-weight: 700;
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
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            border-top: 4px solid var(--primary);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease;
        }

        .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .admin-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
            color: var(--text-dark);
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
            background: rgba(15, 23, 42, 0.5); /* Darker inner bg */
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border);
        }
        
        .stat-item {
            text-align: center;
            width: 100%;
        }
        
        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-gray);
            font-weight: 600;
            letter-spacing: 0.05em;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-top: 0.25rem;
            text-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .btn-call {
            background: linear-gradient(135deg, var(--secondary), #059669);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s ease, transform 0.1s ease;
            width: 100%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
        }

        .btn-call:hover {
            opacity: 0.9;
        }
        
        .btn-call:active {
            transform: scale(0.98);
        }
        
        .btn-call:disabled {
            background: var(--card-hover);
            cursor: not-allowed;
            color: var(--text-gray);
            box-shadow: none;
            transform: none;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--text-gray);
            font-size: 0.875rem;
            border-top: 1px solid var(--border);
            background: rgba(30, 41, 59, 0.5);
        }
    </style>
</head>
<body>

    <header>
        <h1>Admin Panel</h1>
        
        <div class="header-actions">
            <a href="{{ route('home') }}" class="btn-outline">&larr; Publik UI</a>
            
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn-outline" style="border-color: rgba(239,68,68,0.5); color: #FCA5A5;">Logout</button>
            </form>
        </div>
    </header>

    <main>
        <div class="dashboard-header">
            <h2>Manajemen Antrian</h2>
            <p>Panggil nomor antrian berikutnya untuk setiap layanan secara real-time.</p>
        </div>

        <div class="grid-container" id="adminGrid">
            <!-- Rendered by JS -->
            <div style="text-align:center; grid-column: 1 / -1; padding: 2rem; color: var(--text-gray);">
                <p>Memuat data layanan...</p>
            </div>
        </div>
    </main>

    <footer>
        &copy; 2026 Antrian Publik. Hak Cipta Dilindungi.
    </footer>

    <script>
        const baseUrl = "{{ url('/') }}";
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        function callQueue(serviceId) {
            const btn = document.getElementById(`btn-call-${serviceId}`);
            if(btn) {
                btn.disabled = true;
                btn.innerText = 'Memanggil...';
            }
            
            fetch(`${baseUrl}/queue/call`, {
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
                    fetchDashboard();
                } else if (!data.success && data.message === 'Unauthenticated.') {
                    window.location.reload(); // Force reload to go to login
                } else {
                    alert(`Info: ${data.message}`);
                    if(btn) {
                        btn.disabled = false;
                        btn.innerText = 'Panggil Antrian Berikutnya';
                    }
                }
            })
            .catch(err => {
                console.error(err);
                if(err.message.includes('Unexpected token')) {
                     window.location.reload(); // Likely session expired, HTML returned
                } else {
                    alert('Terjadi kesalahan jaringan.');
                }
                if(btn) {
                    btn.disabled = false;
                    btn.innerText = 'Panggil Antrian Berikutnya';
                }
            });
        }
        
        function fetchDashboard() {
            fetch(`${baseUrl}/queue/status`)
                .then(res => {
                    // Check if redirecting to login page (indicates session expiration)
                    if(res.redirected && res.url.includes('login')) {
                        window.location.href = res.url;
                        throw new Error('Unauthenticated');
                    }
                    return res.json();
                })
                .then(data => {
                    const grid = document.getElementById('adminGrid');
                    
                    if(data.summary && data.summary.length > 0) {
                        grid.innerHTML = '';
                        data.summary.forEach(service => {
                            const hasPending = service.pending_count > 0;
                            const btnHtml = hasPending 
                                ? `<button id="btn-call-${service.id}" class="btn-call" onclick="callQueue(${service.id})">Panggil Berikutnya</button>`
                                : `<button id="btn-call-${service.id}" class="btn-call" disabled>Kosong</button>`;
                                
                            // Emerald 400 for 0 pending, Red 400 for > 0 pending
                            const countColor = hasPending ? '#F87171' : '#34D399';
                                
                            const html = `
                                <div class="admin-card">
                                    <h3>${service.name}</h3>
                                    <p>Kode Layanan: ${service.code}</p>
                                    
                                    <div class="queue-stats">
                                        <div class="stat-item">
                                            <div class="stat-label">Sedang Menunggu</div>
                                            <div class="stat-value" style="color: ${countColor}">${service.pending_count}</div>
                                        </div>
                                    </div>
                                    
                                    ${btnHtml}
                                </div>
                            `;
                            grid.innerHTML += html;
                        });
                    } else {
                        grid.innerHTML = `
                            <div style="text-align:center; grid-column: 1 / -1; padding: 3rem; background: var(--card-bg); border-radius: 1rem; border: 1px solid var(--border);">
                                <h3 style="color: var(--text-dark);">Belum ada Layanan</h3>
                                <p style="color: var(--text-gray); margin-top: 0.5rem;">Silakan tambahkan data layanan ke tabel \`services\` di database.</p>
                            </div>
                        `;
                    }
                })
                .catch(err => {
                    if(err.message !== 'Unauthenticated') console.error(err);
                });
        }
        
        // Init
        fetchDashboard();
        setInterval(fetchDashboard, 3000); // Admin poll every 3 seconds
    </script>
</body>
</html>
