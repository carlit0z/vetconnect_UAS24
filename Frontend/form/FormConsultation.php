<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetConnect | Form Konsultasi</title>
    <link rel="shortcut icon"
        href="https://cdn.vectorstock.com/i/500p/88/11/horse-dog-cat-animal-logo-template-vector-34498811.jpg"
        type="image/x-icon">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            background-image: url('https://images.contentstack.io/v3/assets/blt6f84e20c72a89efa/blt050900bb7f9a1b0c/6261cd1685a44126765f5508/img-first-vet-visit-header.jpg');
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            padding-top: 15px;
            margin: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 800px;
        }

        .form-container h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group label {
            font-size: 14px;
            color: #34495e;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #1abc9c;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group .error-message {
            color: #e74c3c;
            font-size: 12px;
            position: absolute;
            bottom: -18px;
            left: 5px;
        }

        .btn {
            width: 100%;
            background: #1abc9c;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #16a085;
        }

        .success-message {
            text-align: center;
            color: #27ae60;
            font-size: 14px;
            margin-top: 20px;
        }

        @media screen and (max-width: 480px) {
            .form-container {
                width: 100%;
                margin: 0 20px;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Buat Jadwal Konsultasi</h2>
        <form id="consultation-form">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" placeholder="Masukkan nama Anda" required>
                <div class="error-message" id="name-error"></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Masukkan email Anda" required>
                <div class="error-message" id="email-error"></div>
            </div>
            <div class="form-group">
                <label for="nama-hewan">Nama Hewan</label>
                <input type="text" id="nama-hewan" placeholder="Masukkan nama hewan Anda" required>
                <div class="error-message" id="nama-hewan-error"></div>
            </div>
            <div class="form-group">
                <label for="message">Pesan Konsultasi</label>
                <textarea id="message" rows="5"
                    placeholder="Masukkan pesan konsultasi Anda, Seperti Penyakit atau Gejala Pada Hewan"></textarea>
                <div class="error-message" id="message-error"></div>
            </div>
            <button type="submit" class="btn">Kirim</button>
            <div class="success-message" id="success-message"></div>
        </form>
    </div>

    <script>
        document.getElementById('consultation-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            // Ambil nilai input
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const petName = document.getElementById('nama-hewan').value;
            const message = document.getElementById('message').value;

            try {
                // Kirim data ke server
                const response = await fetch('http://localhost/VetConnect/Backend/server.php?endpoint=consultations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        owner_name: name,
                        owner_email: email,
                        pet_name: petName,
                        consultation_message: message
                    }),
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('success-message').innerText = 'Konsultasi berhasil dibuat!';
                    document.getElementById('consultation-form').reset();
                } else {
                    alert(data.error || 'Gagal mengirim konsultasi.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    </script>
</body>

</html>