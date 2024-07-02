<script>
    $(".flatpickr").length && flatpickr(".flatpickr", {
        enableTime: true,
        minuteIncrement: 1,
        minDate: "today",
        dateFormat: "Y-m-d H:i:s",
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
    $(document).ready(function() {

        const valueInput = document.getElementById('valueInput');
        const typeCoupon = document.getElementById('typeCoupon');

        valueInput.addEventListener('input', function() {
            const couponValue = Number(valueInput.value.replace(/\./g, '').replace(',', '.'));
            if (!isNaN(couponValue) && typeCoupon.value === 'percent' && couponValue > 100) {
                valueInput.value = '100';
            } else {
                valueInput.value = couponValue.toLocaleString('id-ID', {
                    minimumFractionDigits: 0
                });
            }
        });

        typeCoupon.addEventListener('change', function() {
            const couponValue = Number(valueInput.value.replace(/\./g, '').replace(',', '.'));
            if (!isNaN(couponValue) && typeCoupon.value === 'percent' && couponValue > 100) {
                valueInput.value = '0';
            }
        });
    })
</script>
