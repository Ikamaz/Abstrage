@if(session('success'))
    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>დაემატა</h4>
                <button type="button" class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <span class="check-icon">✓</span>
                <p>პროდუქტი დამატებულია კალათაში!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal()">დახურვა</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('successModal');
            modal.style.display = 'flex';

            setTimeout(function() {
                closeModal();
            }, 3000);
        });

        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
        }
    </script>
@endif
