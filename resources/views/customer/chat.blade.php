@extends('customer.layouts.main')

@section('section')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Add your custom CSS here */
        body {
            background-color: #f8f9fa;
        }

        #chat-box {
            width: 100%;
            height: 500px;
            border: 1px solid #ddd;
            overflow-y: scroll;
            padding: 15px;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #chat-form {
            display: flex;
            margin-top: 10px;
            align-items: center;
        }

        #message {
            flex: 1;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 25px;
            margin-right: 10px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .send-button {
            background-color: #7D009A !important;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .send-button:hover {
            background-color: #59036d;
        }

        .msg-header,
        .msg-bottom {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .msg-header {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .msg-bottom {
            width: 100%;
            margin: 15px 0;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        .chat-message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-end;
        }

        .received-msg {
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 20px;
            max-width: 70%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            display: flex;
            align-items: start;
            text-align: start;
            flex-direction: column;
            justify-content: start;
            align-self: end;
        }

        .outgoing-msg {
            background-color: #7D009A;
            color: #fff;
            padding: 12px;
            border-radius: 20px;
            max-width: 60%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            align-self: flex-end;
        }

        .time {
            font-size: 0.75rem;
            display: flex;
            align-items: start;
            justify-content: start;

        }

        .received-msg-container {}

        .outgoing-msg-container {
            align-items: flex-end;
            justify-content: flex-end;
        }

        .profile_img {
            border-radius: 50%;
            height: 40px;
            width: 40px;
        }

        .file-upload {
            position: relative;
        }

        .file-icon {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .file-icon i {
            font-size: 1.5rem;
            color: #333;
            margin-right: 10px;
        }

        #file-input {
            display: none;
        }

        .file-preview {
            max-width: 200px;
            max-height: 150px;
            margin: 5px 0;
        }

        .file-link {
            display: block;
            /*color: #007bff;*/
            text-decoration: none;
            margin: 5px 0;
        }

        .file-link:hover {
            text-decoration: underline;
        }
    </style>

    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">

                {{-- <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">{{ $title ?? '' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('transporter.index') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
                        </ul>
                    </div>
                </div>
            </div> --}}

                <div class="content">
                    <div class="container-fluid">

                        {{-- <div class="mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <a href="" class="text-decoration-none text-dark">
                            <span><i class="fa-solid fa-arrow-left text-dark fs-4"></i></span>
                        </a>
                        <a href="" class="text-decoration-none text-dark">Back </a>
                    </div>
                </div> --}}

                        <div class="row">
                            <div class="col-3">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="d-flex justify-content-center">
                                            {{-- <img class="rounded-circle"
                                    src="{{ asset('Transporter/profile/image/' . $truck->winingbid->transporter->image) }}" width="100" height="100"
                                    alt="Transporter Image"> --}}
                                            <img class="rounded-circle"
                                                src="{{ $truck->winingbid->transporter->image
                                                    ? asset('Transporter/profile/image/' . $truck->winingbid->transporter->image)
                                                    : asset('assets/img/no-img.jpeg') }}"
                                                width="100" height="100" alt="Transporter Image">

                                        </div>

                                        <ul class="list-group list-group-unbordered mb-3 mt-4">
                                            <li class="list-group-item">
                                                <b> Name:</b>
                                                {{ ucfirst($truck->winingbid->transporter->name ?? '') }}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Email:</b>
                                                {{ $truck->winingbid->transporter->email ?? '' }}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Phone:</b>
                                                {{ $truck->winingbid->transporter->phone ?? '' }}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Date:</b>
                                                {{ $truck->winingbid->created_at->format('d M Y') ?? '' }}
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <div class="col-9">
                                <div class=" chat-container">
                                    <!-- msg-header section starts -->
                                    <div class="msg-header d-flex align-items-center">
                                        {{-- <img class="rounded-circle"
                                    src="{{ asset('Transporter/profile/image/' . $truck->winingbid->transporter->image) }}" width="40" height="40"
                                    alt="Transporter Image"> --}}
                                        <img class="rounded-circle"
                                            src="{{ $truck->winingbid->transporter->image
                                                ? asset('Transporter/profile/image/' . $truck->winingbid->transporter->image)
                                                : asset('assets/img/no-img.jpeg') }}"
                                            width="40" height="40" alt="Transporter Image">

                                        <div class="ml-3 mt-2 ms-2">
                                            <h5>{{ ucfirst($truck->winingbid->transporter->name ?? '') }}</h5>
                                        </div>
                                    </div>
                                    <!-- msg-header section ends -->

                                    <!-- Chat inbox -->
                                    <div id="chat-box"></div>

                                    <!-- msg-bottom section -->
                                    <div class="msg-bottom">
                                        <form id="chat-form" class="d-flex">
                                            <div class="file-upload">
                                                <label for="file-input" class="file-icon">
                                                    <i class="fas fa-paperclip"></i>
                                                    <input type="file" id="file-input" name="file" />
                                                </label>
                                            </div>
                                            <input type="text" id="message" placeholder="Write message..."
                                                class="form-control">
                                            <button type="submit" class="send-button">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            var customerId = '{{ session('customer_id') }}';
            var requestId = '{{ $id }}';

            // console.log(requestId, customerId);

            function fetchMessages() {
                $.ajax({
                    url: '{{ route('get.message', ['id' => $id]) }}',
                    method: 'GET',
                    success: function(response) {
                        $('#chat-box').html('');
                        if (response && response.length > 0) {
                            response.forEach(function(message) {
                                var isOutgoing = message.sender === customerId;
                                var messageTime = new Date(message.created_at)
                                    .toLocaleTimeString([], {
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    });

                                var containerClass = isOutgoing ? 'outgoing-msg-container' :
                                    'received-msg-container';
                                var messageClass = isOutgoing ? 'outgoing-msg' : 'received-msg';

                                var messageContent = message.message ? '<p>' + message.message +
                                    '</p>' : '';
                                var fileHtml = '';
                                if (message.file) {
                                    var fileExtension = message.file.split('.').pop()
                                        .toLowerCase();
                                    var fileUrl = '{{ asset('FileMessage/') }}/' + message
                                    .file;

                                    fileHtml = '<a href="' + fileUrl + '" download="' + message
                                        .file +
                                        '" class="file-download-button"><i class="fa-solid fa-download me-1"></i>Download File</a>';
                                }

                                if (messageContent || fileHtml) {
                                    var messageHTML = '<div class="chat-message ' +
                                        containerClass +
                                        '">' +
                                        '<div class="' + messageClass + '">' +
                                        messageContent +
                                        fileHtml +
                                        '<span class="time">' + messageTime + '</span>' +
                                        '</div>' +
                                        '</div>';

                                    $('#chat-box').append(messageHTML);
                                }
                            });
                            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching messages:', textStatus, errorThrown);
                    }
                });
            }

            fetchMessages();

            $('#chat-form').submit(function(e) {
                e.preventDefault();

                var formData = new FormData();
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('request_id', requestId);

                var message = $('#message').val();
                var fileInput = $('#file-input')[0].files[0];

                if (message) {
                    formData.append('message', message);
                }

                if (fileInput) {
                    formData.append('file', fileInput);
                }

                $.ajax({
                    url: '{{ route('send.message', ['id' => $id]) }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#message').val('');
                        $('#file-input').val('');
                        fetchMessages();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error sending message:', textStatus, errorThrown);
                    }
                });
            });

            setInterval(fetchMessages, 5000);
        });
    </script>
@endsection
