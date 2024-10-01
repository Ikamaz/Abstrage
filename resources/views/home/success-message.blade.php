
@if(session('ordered'))
    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>გადაინახა</h4>
                <button type="button" class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <span class="check-icon"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></span>
                <p>პროდუქტი გადანახულია!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal()">დახურვა</button>
            </div>
        </div>
    </div>
@endif

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
                <button type="button" class="btn-close" onclick="closeModal()">დახურვა</button>
            </div>
        </div>
    </div>
@endif



@if(session('error'))
    <div class="modal-overlay-error" id="successModal">
        <div class="modal-content-error">
            <div class="modal-header-error">
                <h4>არ დაემატა</h4>
                <button type="button" class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body-error">
                <span class="check-icon-error">X</span>
                <p>პროდუქტი უკვე დამატებულია კალათაში!</p>
            </div>
            <div class="modal-footer-error">
                <button type="button" class="btn-error" onclick="closeModal()">დახურვა</button>
            </div>
        </div>
    </div>
@endif

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
