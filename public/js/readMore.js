document.addEventListener('DOMContentLoaded', function() {
        const readMoreBtn = document.getElementById('readMoreBtn');
        const profileContent = document.getElementById('profileContent');

        readMoreBtn.addEventListener('click', function() {
            // Thêm lớp expanded để hiển thị toàn bộ nội dung
            profileContent.classList.add('expanded');
            
            // Ẩn nút "XEM THÊM"
            readMoreBtn.classList.add('hidden');
        });
    });