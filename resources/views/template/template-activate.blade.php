<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <div style="max-width:600px;background:rgb(255,255,255) none repeat scroll 0% 0%;margin:0px auto">
        <table style="font-size:0px;width:100%;background:rgb(255,255,255) none repeat scroll 0% 0%" align="center"
            cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td style="text-align:center;vertical-align:top;font-size:0px">
                        <div class="boxcolumn boxcolumn-100" style="display:inline-block;width:100%;vertical-align:top">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td class="contentalignmentContainer"
                                            style="word-break:break-word;font-size:0px;padding:0px;text-align:center">
                                            {{-- image logo --}}
                                            <img src="{{ asset('assets/logo2_nobg.png') }}" width="90"
                                                height="90"
                                                style="font-family:'Plus Jakarta Sans',sans-serif;font-size:20px">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="max-width:600px;background:rgb(255,255,255) none repeat scroll 0% 0%;margin:0px auto">
        <table style="font-size:0px;width:100%;background:rgb(255,255,255) none repeat scroll 0% 0%" align="center"
            cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td style="text-align:center;vertical-align:top;font-size:0px">
                        <div class="boxcolumn boxcolumn-100" style="display:inline-block;width:100%;vertical-align:top">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td style="font-size:0px;padding:15px;text-align:left">
                                            <div>
                                                {{-- <p class="contenttext-text-block contenttextstyle-scope" align="center" style="color:rgb(52,52,52);font-family:'Plus Jakarta Sans',sans-serif;;font-size:14px;font-weight:bold;padding:0px;margin:0px 0px 13px;line-height:1.6">Hi {{$user->name}}, <br></p> --}}
                                                <p class="contenttext-text-block contenttextstyle-scope" align="center"
                                                    style="color:rgb(52,52,52);font-family:'Plus Jakarta Sans',sans-serif;;font-size:28px;font-weight:bolder;padding:0px;margin:13px 0px;line-height:1.6">
                                                    Verifikasi Email kamu</p>
                                                <p class="contenttext-text-block contenttextstyle-scope" align="center"
                                                    style="color:rgb(52,52,52);font-family:'Plus Jakarta Sans',sans-serif;;font-size:18px;padding:0px;margin:13px 0px;line-height:1.6">
                                                    Tekan tombol dibawah untuk melakukan verifikasi email</p>
                                                <p align="center"
                                                    style="color:#767e81;font-family:'Plus Jakarta Sans', sans-serif;;font-size:16px;font-weight:400;line-height:1.6;margin:0;padding:0">
                                                    <a href="{{ route('auth.activate', [$code]) }}"
                                                        style="display:inline-block;background-color:#0eadff;border-radius:32px;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;;font-weight:700;letter-spacing:1px;margin:0;padding:12px 56px;text-decoration:none"><span
                                                            class="il">Verify</span> Email</a>
                                                </p>
                                                <p class="contenttext-text-block contenttextstyle-scope" align="center"
                                                    style="color:rgb(52,52,52);font-family:'Plus Jakarta Sans',sans-serif;;font-size:15px;padding:0px;margin:13px 0px;line-height:1.6">
                                                    Anda dapat memverifikasi akun Anda dengan menyalin dan menempelkan
                                                    URL di bawah ini ke browser Anda:</p>
                                                <p class="contenttext-text-block contenttextstyle-scope" align="center"
                                                    style="color:rgb(52,52,52);font-family:'Plus Jakarta Sans',sans-serif;;font-size:15px;padding:0px;margin:13px 0px;line-height:1.6">
                                                    <a
                                                        href="{{ route('auth.activate', [$code]) }}">{{ route('auth.activate', [$code]) }}</a>
                                                </p>
                                                <p class="contenttext-text-block contenttextstyle-scope" align="center"
                                                    style="color:rgb(52,52,52);font-family:'Plus Jakarta Sans',sans-serif;;font-size:14px;padding:0px;margin:13px 0px 0px;line-height:1.6">
                                                    <br>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="max-width:600px;background:rgb(255,255,255) none repeat scroll 0% 0%;margin:0px auto">
        <table style="font-size:0px;width:100%;background:rgb(255,255,255) none repeat scroll 0% 0%" align="center"
            cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td style="text-align:center;vertical-align:top;font-size:0px">
                        <div class="boxcolumn boxcolumn-100" style="display:inline-block;width:100%;vertical-align:top">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td style="font-size:0px;padding:15px;text-align:center"
                                            class="contentalignmentContainer">
                                            <div style="margin-left:auto;margin-right:auto">
                                                <p
                                                    style="font-family:'Plus Jakarta Sans',sans-serif;;padding:0px;margin:13px 0px 0px;line-height:1.6;color:rgb(153,153,153);font-size:11px">
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
