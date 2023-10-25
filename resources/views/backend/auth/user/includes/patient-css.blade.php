
@push('after-styles')
    <style>
        .wrap {
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
            border-radius: 4px;
        }

        a:focus,
        a:hover,
        a:active {
            outline: 0;
            text-decoration: none;
        }

        .panel {
            border-width: 0 0 1px 0;
            border-style: solid;
            border-color: #fff;
            background: none;
            box-shadow: none;
        }

        .panel:last-child {
            border-bottom: none;
        }

        .panel-group>.panel:first-child .panel-heading {
            border-radius: 4px 4px 0 0;
        }

        .panel-group .panel {
            border-radius: 0;
        }

        .panel-group .panel+.panel {
            margin-top: 0;
        }

        .panel-heading {
            background-color: #009688;
            border-radius: 0;
            border: none;
            color: #fff;
            padding: 0;
        }

        .panel-title a {
            display: block;
            color: #fff;
            padding: 16px;
            position: relative;
            font-size: 16px;
            font-weight: 400;
        }

        .panel-body {
            background: #fff;
            padding: 8px 16px;
        }

        .panel:last-child .panel-body {
            border-radius: 0 0 4px 4px;
            padding: 8px 16px;
        }

        .panel:last-child .panel-heading {
            border-radius: 0 0 4px 4px;
            transition: border-radius 0.3s linear 0.2s;
        }

        .panel:last-child .panel-heading.active {
            border-radius: 0;
            transition: border-radius linear 0s;
        }

        /* #bs-collapse icon scale option */

        .panel-heading a:before {
            content: '\e146';
            position: absolute;
            font-family: 'Material Icons';
            right: 5px;
            top: 10px;
            font-size: 24px;
            transition: all 0.5s;
            transform: scale(1);
        }

        .panel-heading.active a:before {
            content: ' ';
            transition: all 0.5s;
            transform: scale(0);
        }

        #bs-collapse .panel-heading a:after {
            content: ' ';
            font-size: 24px;
            position: absolute;
            font-family: 'Material Icons';
            right: 5px;
            top: 10px;
            transform: scale(0);
            transition: all 0.5s;
        }

        #bs-collapse .panel-heading.active a:after {
            content: '\e909';
            transform: scale(1);
            transition: all 0.5s;
        }

        /* #accordion rotate icon option */

        #accordion .panel-heading a:before,
        .myaccordion .panel-heading a:before,
        .order-myaccordion .panel-heading a:before,
        #accordionHealthcard .panel-heading a:before,
        #accordionHealthinformation .panel-heading a:before,
        #accordionPaymentmethod .panel-heading a:before,
        #accordionAddress .panel-heading a:before,
        #accordionquandaryInsurance .panel-heading a:before,
        #accordionternaryInsurance .panel-heading a:before,
        #accordionsecondaryInsurance .panel-heading a:before,
        #accordionprimaryInsurance .panel-heading a:before,
        #accordion2 .panel-heading a:before {
            content: '\e316';
            font-size: 24px;
            position: absolute;
            font-family: 'Material Icons';
            right: 5px;
            top: 10px;
            transform: rotate(180deg);
            transition: all 0.5s;
        }

        #accordion .panel-heading.active a:before,
        .myaccordion .panel-heading.active a:before,
        .order-myaccordion .panel-heading.active a:before,
        #accordionHealthcard .panel-heading.active a:before,
        #accordionHealthinformation .panel-heading.active a:before,
        #accordionPaymentmethod .panel-heading.active a:before,
        #accordionAddress .panel-heading.active a:before,
        #accordionquandaryInsurance .panel-heading.active a:before,
        #accordionternaryInsurance .panel-heading.active a:before,
        #accordionsecondaryInsurance .panel-heading.active a:before,
        #accordionprimaryInsurance .panel-heading.active a:before,
        #accordion2 .panel-heading.active a:before {
            transform: rotate(0deg);
            transition: all 0.5s;
        }

        #accordion2 .panel-heading,
        #accordionAddress .panel-heading,
        #accordionHealthinformation .panel-heading,
        #accordionquandaryInsurance .panel-heading,
        #accordionternaryInsurance .panel-heading,
        #accordionsecondaryInsurance .panel-heading,
        #accordionprimaryInsurance .panel-heading,
        #accordionPaymentmethod .panel-heading,
        #accordionAddress .panel-heading,
        #accordionHealthcard .panel-heading {
            background-color: #46a9d6;
            border-radius: 0;
            border: none;
            color: #fff;
            padding: 0;
        }
        .myaccordion .panel-heading,
        .order-myaccordion .panel-heading
        {
            background-color: #02b786;
            border-radius: 0;
            border: none;
            color: #fff;
            padding: 0;
        }



        /* Light box CSS */
        .image-title {
            font-size: 18px;
            text-align: center;
            background: #009689;
            color: #fff;
        }

        .gallery-wrapper {
            max-width: 960px;
            width: 100%;
            margin: 0 auto;
            padding: 0 1em;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            grid-gap: 1em;
        }

        .gallery-wrapper .image-wrapper a {
            padding: 0.5em;
            display: block;
            width: 100%;
            text-decoration: none;
            color: #333;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            transition: all 200ms ease-in-out;
        }

        .gallery-wrapper .image-wrapper a:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .gallery-wrapper .image-wrapper a img {
            width: 100%;
        }

        .gallery-lightboxes .image-lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0ms ease-in-out;
            z-index: 9;
        }

        .gallery-lightboxes .image-lightbox:target {
            opacity: 1;
            visibility: visible;
        }

        .gallery-lightboxes .image-lightbox:target .image-lightbox-wrapper {
            opacity: 1;
            transform: scale(1, 1) translateY(0);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper {
            transform: scale(0.95, 0.95) translateY(-30px);
            transition: opacity 500ms ease-in-out, transform 500ms ease-in-out;
            opacity: 0;
            margin: 1em auto;
            max-width: 75%;
            padding: 0.5em;
            display: inline-block;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
            position: relative;
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .close {
            width: 1.5em;
            height: 1.5em;
            background: #000;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 50%;
            box-shadow: 0 0 0 2px white inset, 0 0 5px rgba(0, 0, 0, 0.5);
            position: absolute;
            right: -1em;
            top: -1em;
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .close:before {
            content: "";
            display: block;
            width: 10px;
            height: 2px;
            background: #fff;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -1px 0 0 -5px;
            transform: rotate(-45deg);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .close:after {
            content: "";
            display: block;
            width: 10px;
            height: 2px;
            background: #fff;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -1px 0 0 -5px;
            transform: rotate(45deg);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .arrow-left {
            position: absolute;
            top: 0;
            right: 50%;
            bottom: 0;
            left: 0;
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .arrow-left:before {
            content: "";
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #fff;
            border-bottom: 0;
            border-right: 0;
            border-radius: 4px 0 0 0;
            position: absolute;
            top: 50%;
            right: 100%;
            cursor: pointer;
            transform: rotate(-45deg) translateY(-50%);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .arrow-right {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 50%;
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .arrow-right:before {
            content: "";
            display: block;
            width: 20px;
            height: 20px;
            border: 2px solid #fff;
            border-bottom: 0;
            border-left: 0;
            border-radius: 0 4px 0 0;
            position: absolute;
            top: 50%;
            left: 100%;
            cursor: pointer;
            transform: rotate(45deg) translateY(-50%);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper img {
            margin: 0 auto;
            max-height: 70vh;
        }

        /*Order Style*/
        .order-medication-details {
            border: 1px dashed red;
            margin-bottom: 8px;
            padding: 6px 12px;
        }

        /* Image privew */
        .imagePreview {
            width: 90px;
            height: 90px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-right: 0;
            position: absolute;
            background-color: #fff;
            top: 0;
            left: 0;
        }

        .file-upload,
        .file-upload-healthcard {
            display: inline-block;
        }

        .file-select {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .file-select.file-select-box {
            width: 90px;
            height: 90px;
            display: inline-block;
            border-radius: 14px;
            box-shadow: 0px 0px 5px 0px #44434347;
        }

        .file-upload-custom-btn {
            width: 90px;
            height: 90px;
            border: none;
            background-color: #5bc3272b;
            color: #289b54;
            font-size: 30px;
            z-index: 1;
            position: relative;
        }

        .file-select-name {
            margin-left: 15px;
        }

        .file-select input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
        }

        .file-select.file-select-box input[type=file] {
            z-index: 2;
        }

        .file-upload+.file-upload,
        .file-upload-healthcard+.file-upload-healthcard {
            margin-left: 10px;
        }

        .file-upload,
        .file-upload-healthcard {
            position: relative;
        }

        button.file-close-custom-btn,
        button.file-close-custom-btn-edit {
            position: absolute;
            right: -6px;
            top: -6px;
            border: 1px;
            border-radius: 100px;
            color: red;
            background: #ff00002b;
            z-index: 2;
        }

        span.address-delete {
            position: absolute;
            right: 16px;
            top: 8px;
            font-size: 22px;
            color: #f30909;
            cursor: pointer;
        }

        span.address-edit {
            position: absolute;
            right: 47px;
            top: 8px;
            font-size: 22px;
            color: #196e0c;
            cursor: pointer;
        }

        p.card-text span {
            width: 100%;
            display: flex;
        }

        span.label.label-info {
            color: #fff;
            background: #099bdd;
            border-radius: 4px;
            padding: 2px 4px;
        }

        .allergies-medications {
            display: none;
        }
        .panel-body form {
            border: 1px solid #ebe0e0;
            padding: 12px;
            border-radius: 4px;
            box-shadow: 0px 0px 8px 0px #ebe0e0;
        }
        p.sub-heading {
            font-style: italic;
            margin: 0;
        }

        .switch-refil .switch-input:checked + .switch-slider {
    background-color: #00b788;
    border-color: #00b788;
}
    </style>
@endpush