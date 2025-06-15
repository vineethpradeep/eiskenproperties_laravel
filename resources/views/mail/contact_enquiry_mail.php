<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Enquiry Confirmed</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .highlight {
            color: #2c3e50;
            font-weight: bold;
        }

        a {
            color: #2c3e50;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Begin Custom Header Section -->
    <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #0f2e50;">
        <tbody>
            <tr>
                <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="color: #ffffff; background-color: #0f2e50; width: 500px; margin: 0 auto;" width="500">
                        <tbody>
                            <tr>
                                <td class="column column-1" width="100%" style="font-weight: 400; text-align: left; padding-bottom: 30px; padding-top: 30px; vertical-align: top;">
                                    <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                <div class="alignment" align="center">
                                                    <div style="max-width: 275px;"><img src="https://res.cloudinary.com/eiskenproperties/image/upload/v1748298061/b8vkrjlbysp1gdkvtv6m.png" style="display: block; height: auto; border: 0; width: 100%;" width="275" alt="Image" title="Image"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- <table class="paragraph_block block-2" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="pad">
                                                <div style="color:#ffffff;font-size:18px;line-height:1.2;text-align:center;">
                                                    <p style="margin: 0;"><span>Swansea Lettings Specialists</span></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #edac15;">
        <tbody>
            <tr>
                <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="color: #000000; width: 500px; margin: 0 auto;" width="500">
                        <tbody>
                            <tr>
                                <td class="column column-1" width="100%" style="font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top;">
                                    <table class="paragraph_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="pad">
                                                <div style="color:#FFFFFF;font-size:14px;line-height:1.2;text-align:center;">
                                                    <p style="margin: 0;"><span>LETTING PROPERTIES &nbsp; -&nbsp; ASK AN AGENT</span></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- End Custom Header Section -->

    <div class="container">
        <div class="header">
            <h1>Thank you for your enquiry</h1>
        </div>

        @dump($enquiry)
        <h2>Hello {{ $enquiry['name'] }},</h2>
        <p>Thank you for reaching out! We have received your contact enquiry and will get back to you soon.</p>

        <p><strong>Email:</strong> {{ $enquiry['email'] }}</p>
        <p><strong>Phone:</strong> {{ $enquiry['phone'] }}</p>

        <p><strong>Interested in scheduling a property - {{$enquiry['property_address'] }} viewing?</strong></p>

        <p>Please schedule your viewing through our website, and we will arrange the appointment for you.
            If you have any questions, do not hesitate to contact us at our office Tel: 01792 644023 or Email: <a href="mailto:enquiries@eiskenp.com">enquiries@eiskenp.com</a>
        </p>

        <!-- Begin Optional Viewing Message -->
        <div style="margin-top: 30px;">
            <p>Our agent will be available to walk you through the property and answer any questions you may have.</p>
        </div>
        <!-- End Optional Viewing Message -->
    </div>
    <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
        <tbody>
            <tr>
                <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="color: #000000; width: 500px; margin: 0 auto;" width="500">
                        <tbody>
                            <tr>
                                <td class="column column-1" width="100%" style="font-weight: 400; text-align: left; padding-top: 5px; vertical-align: top;">
                                    <table class="image_block block-0" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="pad" style="padding-bottom:15px;width:100%;">
                                                <div class="alignment" align="center">
                                                    <div style="max-width: 500px;"><img src="https://res.cloudinary.com/eiskenproperties/image/upload/v1749988842/qwhvlhbubzn4aau3iu5w.png" style="display: block; height: auto; border: 0; width: 100%;" width="500" alt="Image" title="Image"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="paragraph_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="pad" style="padding-left:10px;padding-right:10px;padding-top:10px;">
                                                <div style="color:#333d63;font-family:Georgia,Times,'Times New Roman',serif;font-size:58px;line-height:1.2;text-align:center;">
                                                    <p style="margin: 0;"><span>BUY / SELL WITH US</span></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="button_block block-3" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="pad">
                                                <div class="alignment" align="center">
                                                    <a href="mailto:enquiries@eiskenp.com?subject=Enquiry" target="_blank" title="enquiries@eiskenp.com" style="color:#ffffff;text-decoration:none;">
                                                        <span class="button" style="background-color: #0E2E50; color: #ffffff; display: inline-block; font-family: Georgia, Times, 'Times New Roman', serif; font-size: 16px; padding: 5px 20px; text-align: center; width: auto;">CONTACT US</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="row row-5" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #ffffff;">
        <tbody>
            <tr>
                <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="color: #000000; background-color: #ffffff; width: 500px; margin: 0 auto;" width="500">
                        <tbody>
                            <tr>
                                <td class="column column-1" width="100%" style="font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top;">
                                    <table class="icons_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="text-align: center; line-height: 0;">
                                        <tr>
                                            <td class="pad" style="vertical-align: middle; color: #1e0e4b; font-family: 'Inter', sans-serif; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                <table class="icons-inner" cellpadding="0" cellspacing="0" role="presentation" style="display: inline-block;">
                                                    <tr>
                                                        <td style="vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px;"><a href="http://www.dotseek.co.uk/" target="_blank" style="text-decoration: none;"><img class="icon" alt="Beefree Logo" src="https://res.cloudinary.com/eiskenproperties/image/upload/v1748298333/whiyf4orwiufsbiq9zht.jpg" width="60" style="display: block; height: auto; margin: 0 auto; border: 0;"></a></td>
                                                        <td style="font-family: 'Inter', sans-serif; font-size: 12px; color: #1e0e4b; vertical-align: middle; text-align: center;"><a href="http://www.dotseek.co.uk/" target="_blank" style="color: #1e0e4b; text-decoration: none;">Designed with Dotseek</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
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