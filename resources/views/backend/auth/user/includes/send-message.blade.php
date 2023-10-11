<button class="btn btn-success send-message-btn" style="float: right;" data-toggle="modal" data-target="#send-message">Send
    Message</button>

<div id="send-message" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Send Message</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span class="" id="send-message-error"></span>
                <input type="hidden" id="active-tab-val" value="{{ $tab }}">
                <label for="send-sms" class="btn btn-primary">SMS <input type="checkbox" id="send-sms"
                        class="badgebox"><span class="badge">&check;</span></label>
                <label for="send-email" class="btn btn-success">EMAIL <input type="checkbox" id="send-email"
                        class="badgebox"><span class="badge">&check;</span></label>

                <label for="send-custom" class="btn btn-warning">Custom Message <input type="checkbox" id="send-custom"
                        class="badgebox-custom"><span class="badge">&check;</span></label>
                        <input type="hidden" name="dialing_code" id="dialing-code" value="{{$user->dialing_code}}">
                        <input type="hidden" name="mobile_no" id="mobile-no" value="{{$user->mobile_no}}">
                        <input type="hidden" name="user_email" id="user-email" value="{{$user->email}}">
                {{ Form::select('message', $auto_messages, null, ['id' => 'message-data', 'class' => 'form-control box-size', 'placeholder' => trans('Select Messages')]) }}
                {{ Form::textarea('custom_message', null, ['id' => 'custom-message', 'class' => 'form-control input', 'cols' => 20, 'rows' => 5, 'maxlength' => '400']) }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="send_message()">Send</button>

                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



@push('after-scripts')
    <script>
        function send_message(id) {
            var isSmsChecked = $("#send-sms").is(":checked");
            var isEmailChecked = $("#send-email").is(":checked");
            var iscustomChecked = $("#send-custom").is(":checked");
            var message_data = $('#message-data :selected').val();
            var custom_message = $('#custom-message').val();
            var user_email = $('#user-email').val();
            var mobile_no = $('#mobile-no').val();
            var dialing_code = $('#dialing-code').val();
            if (!isSmsChecked && !isEmailChecked) {
                $("#send-message-error").html('Select Any one message line');
                return false;
            } else {
                if (isSmsChecked && isEmailChecked) {
                        if(mobile_no==''){
                            $("#send-message-error").html('Update Mobile of patient');
                            return false;
                        }else if(user_email==''){
                            $("#send-message-error").html('Update Email of patient');
                            return false;
                        }
                }else if(isSmsChecked && !isEmailChecked){
                        if(mobile_no==''){
                            $("#send-message-error").html('Update Mobile of patient');
                            return false;
                        }
                }else if(!isSmsChecked && isEmailChecked){
                        if(user_email==''){
                            $("#send-message-error").html('Update Email of patient');
                            return false;
                        }
                }
                $("#send-message-error").text('');
                if (iscustomChecked) {
                    if (custom_message == "") {
                        $("#send-message-error").html('Message Required!');
                         return false;
                    } else {
                        $("#send-message-error").text('');
                        message = custom_message;
                    }
                } else {
                    if (message_data == "") {
                        $("#send-message-error").html('Select Message!');
                        return false;
                    } else {
                        $("#send-message-error").text('');
                        message = $('#message-data :selected').text();
                    }
                }
                $("#overlay").fadeIn(300);
                 var ajaxurl = "{{ route('admin.auth.user.send.message') }}";
                 $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {_token: '{{ csrf_token() }}', isSmsChecked:isSmsChecked,isEmailChecked:isEmailChecked,message:message,dialingCode:dialing_code,mobile_no:mobile_no,user_email:user_email},
                    dataType: 'JSON',
                    success: function (data) {
                    if(data==1){
                    $('#send-sms').prop('checked',false);
                    $('#send-email').prop('checked',false);
                    $('#send-custom').prop('checked',false);
                    $('#custom-message').val('');
                    $('#message-data').prop('selectedIndex',0);
                    $('#message-data').show();
                    $('#custom-message').hide();
                    $("#send-message").modal("hide");
                    } 
                    $("#overlay").fadeOut(300);
                    
                     console.log(data);
                       // $(".writeinfo").append(data.msg); 

                    }
                }); 

            }

        }
        $(document).ready(function() {
            $('.badgebox').click(function() {
                if ($(this).prop("checked") == true) {
                    $("#send-message-error").text('');
                }

            });

            $('.badgebox-custom').click(function() {
                if ($(this).prop("checked") == true) {
                $("#send-message-error").text('');
                    $("#message-data").hide();
                    $("#custom-message").show();
                } else {
                    $("#send-message-error").text('');
                    $("#custom-message").hide();
                    $("#message-data").show();
                }

            });

        });
    </script>
@endpush
@push('after-styles')
    <style>
        #custom-message {
            display: none;
        }

        .badgebox,
        .badgebox-custom {
            opacity: 0;
        }

        .badgebox+.badge,
        .badgebox-custom+.badge {
            text-indent: -999999px;
            width: 18px;
            background: #fff;
            color: #000;
            font-size: 11px;
        }

        .badgebox:focus+.badge,
        .badgebox-custom:focus+.badge {
            /* Set something to make the badge looks focused */
            /* This really depends on the application, in my case it was: */

            /* Adding a light border */
            /* box-shadow: inset 0px 0px 5px; */
            /* Taking the difference out of the padding */
        }

        .badgebox:checked+.badge,
        .badgebox-custom:checked+.badge {
            /* Move the check mark back when checked */
            text-indent: 0;
        }
    </style>
@endpush
