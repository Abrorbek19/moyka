$(document).ready(function(){
    let token = "6106791463:AAHaT_-O8NSBLb6EB0GGa_bl647fhrfySPY";
    let userId = 1168146742
    nameInput = $('#name');
    emailInput = $('#email');
    textInput = $('#text');

    // phone.inputmask({"mask": "+998-()-999-99-99"});

    $('#form').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: '/message', // Saytga yuborishning URL yo'li
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: {
                //   _token: name,
                name: nameInput.val(),
                email: emailInput.val(),
                text: textInput.val(),
            },
            success: function(data) {
                // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                console.log('Your message has been sent to admin')
                $('#submit').slideDown();
                location.reload()
            },
            error: function() {
                console.log("Message adminga bormadi")
                // Saytga yuborilgan xabar qabul qilinmadi
            }
        });


    });
});
