<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.0.4/socket.io.js"
    integrity="sha512-aMGMvNYu8Ue4G+fHa359jcPb1u+ytAF+P2SCb+PxrjCdO3n3ZTxJ30zuH39rimUggmTwmh2u7wvQsDTHESnmfQ=="
    crossorigin="anonymous"></script>

<script>
    $(function() {

        // connect to server
        const socket = io('http://546811de5bbd.ngrok.io?token=6099af39d4141', {
            transports: ['websocket']
        });

        let sendMsg = function(n, m) {
            socket.emit('send', {
                numbers: n,
                message: m
            });
        }

        socket.on('send', function(e) {
            if (e.status) {
                $('#msg-alert').html('<div class="alert alert-success">Message sent<div>');
            } else {
                $('#msg-alert').html(
                    '<div class="alert alert-danger">Something went wrong, not able to send SMS as of this time, contact administrator<div>'
                );
            }

            $('#form button').text('Send SMS').prop('disabled', false);

            $('#form input,#form textarea').val('');
        });


        $('#form').on('submit', function(e) {
            e.preventDefault();

            if ($.trim($(this).find('#numbers').val()) == '') {
                alert('Recipients is required');
                return;
            }

            $(this).find('button').text('Sending...').prop('disabled', true);

            sendMsg($.trim($('#numbers').val()).split(','), $('#message').val());

        });


    });

</script>
