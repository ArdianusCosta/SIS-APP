<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Developer - SIS-APP</title>
    <link rel="icon" href="/img/logo-SIS.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen font-sans">
    <div class="flex flex-col md:flex-row min-h-screen border-4 border-[#999999]">
        <div class="md:w-1/2 bg-[#f2f0f7] p-8 flex flex-col justify-center">
            <div class="flex items-center mb-8">
                <img src="/img/logo-SIS.jpg" alt="SIS-APP Logo" class="h-12 w-12 mr-3">
                <h1 class="text-2xl font-bold text-black">SIS-APP</h1>
            </div>
            <form id="contactForm" action="{{route('contact-to-speedseat.store')}}" method="POST" class="space-y-4">
                @csrf
                <div class="flex gap-4">
                    <input type="text" name="nama" placeholder="Nama" class="w-1/2 p-3 rounded-full bg-[#d3d3d3] placeholder-gray-700 focus:outline-none" required>
                    <input type="text" name="phone" placeholder="No Handphone" class="w-1/2 p-3 rounded-full bg-[#d3d3d3] placeholder-gray-700 focus:outline-none" required>
                </div>
                <input type="email" name="email" placeholder="Email" class="w-full p-3 rounded-full bg-[#d3d3d3] placeholder-gray-700 focus:outline-none" required>
                <textarea name="pesan_to_costa" rows="4" placeholder="Pesan" class="w-full p-3 rounded-2xl bg-[#d3d3d3] placeholder-gray-700 focus:outline-none" required></textarea>
                <button type="submit" class="bg-[#f8b9c0] text-black px-6 py-2 rounded-full hover:bg-[#f49da8]">Hubungi</button>
            </form>
        </div>

        <div class="md:w-1/2 bg-[#999999] relative p-6 flex flex-col justify-center items-center">
            <a href="#" class="absolute top-6 right-6 bg-[#f8b9c0] text-black px-4 py-1 rounded-full text-sm hover:bg-[#f49da8]" onclick="window.history.back();return false;">Kembali</a>
            <h2 class="text-4xl font-bold text-black mb-6">Hubungi Developer</h2>
            <img src="{{ asset('img/contact-dev.jpg') }}" alt="Paper Plane" class="w-48 md:w-64">
        </div>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
        
            const formData = {
                nama: this.nama.value,
                phone: this.phone.value,
                email: this.email.value,
                pesan_to_costa: this.pesan_to_costa.value
            };
        
            fetch('https://script.google.com/macros/s/AKfycbwU5U2e0qJl3WAdbcAAfrRbjsYdfPi-RRqrFuaMm_lzZCLTAaUPLL2LC38AncfHR7Xnjg/exec', {
                method: 'POST',
                body: JSON.stringify(formData),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(r => r.json())
            .then(response => {
                alert('Pesan berhasil dikirim!');
                document.getElementById('contactForm').reset();
            })
            .catch(error => alert('Gagal mengirim pesan.'));
        });
        </script>
        
</body>
</html>
