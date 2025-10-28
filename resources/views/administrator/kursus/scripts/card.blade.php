<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ route('kursus.data') }}',
            method: 'GET',
            success: function(data) {
                let html = '';

                data.forEach(function(kursus) {
                    html += `
                        <div class="col-md-4 col-xl-3">
                            <div class="modern-card">
                                <div class="card-header-img">
                                    <img src="${kursus.gambar}" alt="${kursus.judul}">
                                    <div class="course-title-overlay">${kursus.judul}</div>
                                </div>
                                <div class="card-body-info">
                                    <h6 class="instructor-name">${kursus.nama_instruktur}</h6>
                                    <p class="instructor-field">${kursus.bidang_keahlian}</p>
                                    <a href="/master/peserta-kursus/create?kursus_id=${kursus.id_kursus}" class="btn-join">Daftar</a>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $('#container-kursus').html(html);
            },
            error: function() {
                $('#container-kursus').html('<p class="text-danger">Gagal memuat data kursus.</p>');
            }
        });
    });
</script>
