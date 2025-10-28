<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $.getJSON('{{ route('dashboard.data') }}', function(res) {
            // Peserta per kursus
            const kursusLabels = res.perKursus.map(r => r.judul);
            const kursusData = res.perKursus.map(r => r.total);
            new Chart($('#chartPerKursus'), {
                type: 'bar',
                data: {
                    labels: kursusLabels,
                    datasets: [{
                        label: 'Jumlah Peserta',
                        data: kursusData,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    }]
                },
                options: {
                    responsive: true
                }
            });

            // Peserta baru per bulan
            const bulanLabels = res.perBulan.map(r => r.bulan);
            const bulanData = res.perBulan.map(r => r.total);
            new Chart($('#chartPerBulan'), {
                type: 'line',
                data: {
                    labels: bulanLabels,
                    datasets: [{
                        label: 'Pendaftaran Peserta',
                        data: bulanData,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)'
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    });
</script>
