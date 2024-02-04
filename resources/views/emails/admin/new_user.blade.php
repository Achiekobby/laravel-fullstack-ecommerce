<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>

        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap");

            .two-columns{
                font-size: 0;
                text-align: left;
            }

            .two-columns .column{
                width: 100%;
                max-width: 300px;
                vertical-align: middle;
            }

            .social-media{
                padding: 12px 0 12px 200px;
            }
        </style>
    </head>
    <body style="font-family: Poppins;">
        <center style="width: 100%; table-layout: fixed">
            <table
                width="100%"
                style="
                    border-spacing: 0px;
                    width: 100%;
                    max-width: 600px;
                    font-family: sans-serif;
                "
            >

                    <tr>
                        <td style="padding: 10px;">
                            <a
                                href="https://ubuntugraphix.com/"
                                target="_blank"
                                data-saferedirecturl="https://www.google.com/url?q=https://ubuntugraphix.com/&amp;source=gmail&amp;ust=1700496108479000&amp;usg=AOvVaw0LhFoBC2EnWiljRF40_gAC"
                                >
                                {{-- <img
                                    src="https://client.manduu.work/assets/common/images/app-logo-on-dark.svg"
                                    alt="Logo"
                                    width="130px"
                                    style="border: 0px"
                                    class="CToWUd"
                                    data-bit="iit"
                            /> --}}
                        </a>
                        </td>
                    </tr>
                    <tr>
                        <td height="1" style="background-color: rgba(226, 232, 215, 0.5); border-radius:10px;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 0px">
                            <table
                                style="
                                    color: rgb(22, 22, 22);
                                    font-size: 14px;
                                    font-family: Ubuntu, sans-serif;
                                    line-height: 24px;
                                    border-spacing: 0px;
                                    margin-top:30px;
                                "
                            >
                                    <tr>
                                        <td style="padding: 0px; font-weight:600; font-size:18px; font-family:Poppins">
                                            Welcome to ecommerce-app-name!,
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px;">
                                            <p>Hi {{$mail_data["name"]}},</p>
                                            <p style="margin-top:-10px ;">Thanks for signing up!</p>
                                            <p style="margin-top:-10px ;"> You have been added as an admin for ecommerce site name</p>
                                            <p style="margin-top:-10px ;"> Please  the credentials below to access your account: </p>
                                            <p style="margin-top:-10px ;"> Admin-Portal: {{$mail_data['portal_endpoint']}} </p>
                                            <p style="margin-top:-10px ;"> Email: {{$mail_data['email']}} </p>
                                            <p style="margin-top:-10px ;"> Password: {{$mail_data['password']}} </p>

                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- <td>
                                            <p>Once your account is activated you
                                                will be able to log in</p>
                                            <p style="margin-top:-10px ;">and book your
                                                first session.</p>
                                        </td> --}}
                                    </tr>
                                    <tr style="margin-top: 10px">
                                        <td>
                                            <p>Cheers</p>
                                            <p style="margin-top:-10px ;">Team commerce!</p>
                                        </td>
                                    </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td width="100%"><small style="font-size: 12px; font-weight:400; font-family:Poppins;"
                                        >support@example.com</small
                                    ></td>
                                    <td>
                                        <p style="text-align: right;display: flex; justify-items:end;">
                                            <a style="display: inline-block; text-decoration:none; margin-left:10px;" href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                                    <g fill="#93d500" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M15,3c-6.627,0 -12,5.373 -12,12c0,6.016 4.432,10.984 10.206,11.852v-8.672h-2.969v-3.154h2.969v-2.099c0,-3.475 1.693,-5 4.581,-5c1.383,0 2.115,0.103 2.461,0.149v2.753h-1.97c-1.226,0 -1.654,1.163 -1.654,2.473v1.724h3.593l-0.487,3.154h-3.106v8.697c5.857,-0.794 10.376,-5.802 10.376,-11.877c0,-6.627 -5.373,-12 -12,-12z"></path></g></g>
                                                    </svg>
                                            </a>
                                            <a style="display: inline-block; text-decoration:none; margin-left:10px;" href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                                    <g fill="#93d500" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M15,2c-7.168,0 -13,5.832 -13,13c0,7.168 5.832,13 13,13c7.168,0 13,-5.832 13,-13c0,-7.168 -5.832,-13 -13,-13zM11.66602,6h6.66602c3.125,0 5.66797,2.54202 5.66797,5.66602v6.66602c0,3.125 -2.54202,5.66797 -5.66602,5.66797h-6.66602c-3.125,0 -5.66797,-2.54202 -5.66797,-5.66602v-6.66602c0,-3.125 2.54202,-5.66797 5.66602,-5.66797zM11.66602,8c-2.021,0 -3.66602,1.64597 -3.66602,3.66797v6.66602c0,2.021 1.64597,3.66602 3.66797,3.66602h6.66602c2.021,0 3.66602,-1.64597 3.66602,-3.66797v-6.66601c0,-2.021 -1.64597,-3.66602 -3.66797,-3.66602zM19.66797,9.66602c0.368,0 0.66602,0.29802 0.66602,0.66602c0,0.368 -0.29801,0.66797 -0.66602,0.66797c-0.368,0 -0.66797,-0.29997 -0.66797,-0.66797c0,-0.368 0.29997,-0.66602 0.66797,-0.66602zM15,10c2.757,0 5,2.243 5,5c0,2.757 -2.243,5 -5,5c-2.757,0 -5,-2.243 -5,-5c0,-2.757 2.243,-5 5,-5zM15,12c-1.65685,0 -3,1.34315 -3,3c0,1.65685 1.34315,3 3,3c1.65685,0 3,-1.34315 3,-3c0,-1.65685 -1.34315,-3 -3,-3z"></path></g></g>
                                                    </svg>
                                            </a>
                                            <a style="display: inline-block; text-decoration:none; margin-left:10px;" href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                                    <g fill="#93d500" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M15,3c-6.627,0 -12,5.373 -12,12c0,6.627 5.373,12 12,12c6.627,0 12,-5.373 12,-12c0,-6.627 -5.373,-12 -12,-12zM21.464,12.535c0.006,0.133 0.009,0.265 0.009,0.397c0,4.068 -3.095,8.756 -8.756,8.756c-1.739,0 -3.356,-0.509 -4.717,-1.383c0.241,0.029 0.486,0.042 0.735,0.042c1.443,0 2.769,-0.491 3.821,-1.318c-1.347,-0.025 -2.484,-0.915 -2.875,-2.137c0.188,0.036 0.381,0.055 0.579,0.055c0.281,0 0.554,-0.038 0.811,-0.108c-1.408,-0.282 -2.469,-1.526 -2.469,-3.017c0,-0.013 0,-0.026 0,-0.039c0.415,0.231 0.889,0.369 1.394,0.385c-0.825,-0.551 -1.369,-1.494 -1.369,-2.561c0,-0.565 0.151,-1.094 0.416,-1.547c1.518,1.862 3.786,3.088 6.343,3.216c-0.052,-0.225 -0.079,-0.46 -0.079,-0.701c0,-1.699 1.378,-3.078 3.077,-3.078c0.885,0 1.685,0.374 2.246,0.972c0.701,-0.139 1.36,-0.394 1.955,-0.747c-0.23,0.719 -0.718,1.321 -1.354,1.703c0.622,-0.074 1.215,-0.239 1.768,-0.484c-0.411,0.618 -0.932,1.159 -1.535,1.594z"></path></g></g>
                                                    </svg>
                                            </a>
                                            <a style="display: inline-block; text-decoration:none; margin-left:10px;" href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                                    <g fill="#93d500" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M15,3c-6.627,0 -12,5.373 -12,12c0,6.627 5.373,12 12,12c6.627,0 12,-5.373 12,-12c0,-6.627 -5.373,-12 -12,-12zM10.496,8.403c0.842,0 1.403,0.561 1.403,1.309c0,0.748 -0.561,1.309 -1.496,1.309c-0.842,0.001 -1.403,-0.561 -1.403,-1.309c0,-0.748 0.561,-1.309 1.496,-1.309zM12,20h-3v-8h3zM22,20h-2.824v-4.372c0,-1.209 -0.753,-1.488 -1.035,-1.488c-0.282,0 -1.224,0.186 -1.224,1.488c0,0.186 0,4.372 0,4.372h-2.917v-8h2.918v1.116c0.376,-0.651 1.129,-1.116 2.541,-1.116c1.412,0 2.541,1.116 2.541,3.628z"></path></g></g>
                                                    </svg>
                                            </a>
                                        </p>
                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <tr>
                            <td height="1" style="background-color: rgba(226, 232, 215, 0.5);"></td>
                        </tr>                    </tr>
                    <tr style="margin-top:20px ;">
                        <td style="color: gray; font-size: 12px">
                            <p> &copy; 2023. All rights reserved</p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="
                                color: gray;
                                font-size: 12px;
                                padding-top: 20px;
                            "
                        >

                        </td>
                    </tr>
            </table>
        </center>
    </body>
</html>
