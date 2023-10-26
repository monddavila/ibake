<script>
    // Listen for the "Submit" button click in the modal
    document.getElementById('modalSubmitButton').addEventListener('click', function() {
        // Collect data from the regular form
        const regularData = {
            cakeOrderImage: document.getElementById('cakeOrderImage').files[0],
            cakeMessage: document.getElementById('cakeMessage').value,
        };

        // Collect data from the modal form
        const modalData = {
            cake_size: document.getElementById('cake_size').value,
            icing: document.getElementById('icing').value,
            celebrant_name: document.getElementById('celebrant_name').value,
            celebrant_birthday: document.getElementById('celebrant_birthday').value,
            delivery_date: document.getElementById('delivery_date').value,
            delivery_time: document.getElementById('delivery_time').value,
            location: document.getElementById('location').value,

            // Add other modal fields here
        };

        // Combine the data from both forms
        const formData = new FormData();
        formData.append('cakeOrderImage', regularData.cakeOrderImage);
        formData.append('cakeMessage', regularData.cakeMessage);
        formData.append('icing', modalData.cake_size);
        formData.append('cake_size', modalData.icing);
        formData.append('celebrant_name', modalData.celebrant_name);
        formData.append('celebrant_birthday', modalData.celebrant_birthday);
        formData.append('delivery_date', modalData.delivery_date);
        formData.append('delivery_time', modalData.delivery_time);
        formData.append('location', modalData.location);
        // Add other modal fields to the formData as needed

        // Now, you can submit the combined data to your server using an AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route('combinedFormSubmit') }}', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server if needed
            }
        };
        xhr.send(formData);
    });
</script>
