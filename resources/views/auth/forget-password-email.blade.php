<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <!--[if mso]><style type="text/css">body, table, td, a { font-family: Arial, Helvetica, sans-serif !important; }</style><![endif]-->
</head>

<body style="font-family: Helvetica, Arial, sans-serif; margin: 0px; padding: 0px; background-color: #ffffff;">
  <table role="presentation"
    style="width: 100%; border-collapse: collapse; border: 0px; border-spacing: 0px; font-family: Arial, Helvetica, sans-serif; background-color: rgb(239, 239, 239);">
    <tbody>
      <tr>
        <td align="center" style="padding: 1rem 1rem; vertical-align: top; width: 100%;">
          <table role="presentation" style="max-width: 800px; border-collapse: collapse; border: 0px; border-spacing: 0px; text-align: left;">
            <tbody>
              <tr>
                <td style="padding: 20px 0px 0px;">
                  <div style="text-align: left;">
                    <!--<div style="padding-bottom: 20px;"><img src="{{ URL::to('assets/img/avtar.jpg') }}" alt="Company" style="width: 56px;"></div>-->
                  </div>
                  <div style="padding: 30px; background-color: rgb(255, 255, 255);">
                    <div style="color: rgb(0, 0, 0); text-align: left;">
                      <h2 style="margin: 1rem 0">Forgot Password Verification code</h2>
                      <p style="padding-bottom: 16px">Please use the verification code below to reset your password.</p>
                      <p style="padding-bottom: 16px"><strong style="font-size: 130%">{{ $token }}</strong></p>
                      <p style="padding-bottom: 16px">If you didn’t request this, you can ignore this email.</p>
                      <p style="padding-bottom: 16px">Thanks,<br>The NoteTech team</p>
                    </div>
                  </div>
                  <div style="padding-top: 20px; color: rgb(153, 153, 153); text-align: center;">
                    {{-- <p style="padding-bottom: 16px">Made with ♥ in Paris</p> --}}
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>
