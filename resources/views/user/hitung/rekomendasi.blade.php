<!DOCTYPE html>
<html>
<head>
    <title>Hasil Rekomendasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f9;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .recommendation-list {
            list-style: none;
            padding: 0;
        }
        .recommendation-item {
            background: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .recommendation-item h2 {
            margin: 0 0 10px;
            color: #333;
        }
        .recommendation-item p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Hasil Rekomendasi</h1>

    @if($rekomendasi->isEmpty())
        <p>Tidak ada rekomendasi yang sesuai dengan kriteria Anda.</p>
    @else
        <ul class="recommendation-list">
            @foreach($rekomendasi as $item)
                <li class="recommendation-item">
                    <h2>{{ $item->nama }}</h2>
                    <p><strong>Alamat:</strong> {{ $item->objek->alamat ?? 'Informasi alamat tidak tersedia' }}</p>
                    <p><strong>Fasilitas:</strong> {{ $item->objek->fasilitas ?? 'Informasi fasilitas tidak tersedia' }}</p>
                    <p><strong>Harga:</strong> {{ $item->objek->harga ?? 'Informasi harga tidak tersedia' }}</p>
                    <p><strong>Jam Operasional:</strong> {{ $item->objek->jam_operasional ?? 'Informasi jam operasional tidak tersedia' }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
