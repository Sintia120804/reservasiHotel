<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Reservasi - {{ $reservation->room->room_number }}</title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        .print-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .hotel-name {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }
        
        .document-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .reservation-number {
            font-size: 16px;
            color: #666;
        }
        
        .reservation-date {
            font-size: 14px;
            color: #888;
            margin-top: 5px;
        }
        
        .verification-code {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            font-family: monospace;
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 3px;
            display: inline-block;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .info-item {
            margin-bottom: 15px;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #333;
            font-size: 16px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            background-color: #28a745;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .price {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        
        .badge {
            font-size: 12px;
            padding: 5px 10px;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #007bff;
            text-align: center;
        }
        
        .footer-text {
            color: #666;
            font-size: 14px;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .print-button:hover {
            background: #0056b3;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            text-align: center;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            color: white;
        }
        
        @media print {
            .print-button {
                display: none;
            }
            body {
                background: white;
            }
            .print-container {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <button class="print-button no-print" onclick="window.print()">
        🖨️ Cetak
    </button>
    
    <button class="print-button no-print" onclick="downloadPDF()" style="right: 120px;">
        �� PDF
    </button>
    
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-secondary">
            ← Kembali ke Detail Reservasi
        </a>
        <p style="color: #666; margin-top: 10px; font-size: 14px;">
            💡 Tips: Gunakan Ctrl+P untuk mencetak atau simpan sebagai PDF
        </p>
    </div>
    
    <div class="print-container">
        <div class="header">
            <div class="hotel-name">HOTEL SINTA</div>
            <div class="document-title">BUKTI RESERVASI</div>
            <div class="reservation-number">Nomor Reservasi: #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</div>
            <div class="reservation-date">Dibuat pada: {{ $reservation->created_at->format('d F Y H:i') }}</div>
            <div class="verification-code">Kode Verifikasi: {{ strtoupper(substr(md5($reservation->id . $reservation->user_id), 0, 8)) }}</div>
            <div style="font-size: 11px; color: #999; margin-top: 5px;">
                * Kode ini digunakan untuk verifikasi keabsahan reservasi
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">Informasi Tamu</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nama</div>
                    <div class="info-value">{{ $reservation->user->name }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $reservation->user->email }}</div>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">Detail Kamar</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nomor Kamar</div>
                    <div class="info-value" style="font-size: 20px; font-weight: bold; color: #007bff;">{{ $reservation->room->room_number }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tipe Kamar</div>
                    <div class="info-value">{{ $reservation->room->roomType->name }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kapasitas</div>
                    <div class="info-value">{{ $reservation->room->roomType->capacity }} orang</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Harga per Malam</div>
                    <div class="info-value">Rp{{ number_format($reservation->room->roomType->price_per_night, 0, ',', '.') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="status-badge">{{ ucfirst($reservation->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">Detail Reservasi</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Tanggal Check-in</div>
                    <div class="info-value">{{ $reservation->check_in_date->format('d F Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Check-out</div>
                    <div class="info-value">{{ $reservation->check_out_date->format('d F Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Jumlah Tamu</div>
                    <div class="info-value">{{ $reservation->number_of_guests }} orang</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Durasi Menginap</div>
                    <div class="info-value">{{ $reservation->check_in_date->diffInDays($reservation->check_out_date) }} malam</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total Harga</div>
                    <div class="info-value price">Rp{{ number_format($reservation->total_price, 0, ',', '.') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status Pembayaran</div>
                    <div class="info-value">
                        <span class="status-badge" style="background-color: #28a745;">Lunas</span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Metode Pembayaran</div>
                    <div class="info-value">Bayar di Hotel (Cash/Card)</div>
                </div>
            </div>
        </div>
        
        @if($reservation->room->roomType->facilities->count() > 0)
        <div class="section">
            <div class="section-title">Fasilitas Kamar</div>
            <div class="info-value">
                @foreach($reservation->room->roomType->facilities as $facility)
                    <span class="badge bg-info me-2 mb-2">{{ $facility->name }}</span>
                @endforeach
            </div>
        </div>
        @endif
        
        @if($reservation->special_requests)
        <div class="section">
            <div class="section-title">Permintaan Khusus</div>
            <div class="info-value">{{ $reservation->special_requests }}</div>
        </div>
        @endif
        
        @if($reservation->admin_notes)
        <div class="section">
            <div class="section-title">Catatan Admin</div>
            <div class="info-value">{{ $reservation->admin_notes }}</div>
        </div>
        @endif
        
       
    </div>
    
    <script>
        // Auto print when page loads (optional)
        // window.onload = function() {
        //     window.print();
        // }
        
        // Function to download as PDF
        function downloadPDF() {
            // You can implement PDF generation here
            // For now, we'll just trigger print which can save as PDF
            window.print();
        }
    </script>
</body>
</html> 