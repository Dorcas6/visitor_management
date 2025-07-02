<script>
    const modalOverlay = document.getElementById('modalOverlay');
    const modalContent = document.getElementById('modalContent');
    const closeModalBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    let deleteForm = document.getElementById("delete-form");

    // Fonction pour ouvrir le modal
    function openModal(event) {
        console.log("Event:", event);
        
        modalOverlay.classList.remove('hidden');
        deleteForm.action = event.target.getAttribute("data-action");
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    // Fonction pour fermer le modal
    function closeModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modalOverlay.classList.add('hidden');
        }, 300);
    }

    
    // Event listeners
    document.querySelectorAll('[data-role="delete-model"]').forEach(openModalBtn => {
        openModalBtn.addEventListener('click', openModal);
    });
    closeModalBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    
    // Fermer le modal en cliquant sur l'overlay
    modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) {
            closeModal();
        }
    });

    // Fermer le modal avec la touche Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modalOverlay.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Action du bouton confirmer
    confirmBtn.addEventListener('click', () => {
        closeModal();
        deleteForm.submit();
    });
    
    function toggleDropdown(button) {
        const menu = button.nextElementSibling;
        menu.classList.toggle('hidden');
    }

    window.addEventListener('click', function (e) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (!menu.previousElementSibling.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });

</script>
