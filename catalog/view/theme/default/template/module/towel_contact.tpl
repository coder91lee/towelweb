<div id="wrapper">
    <div class="urlsite_map">
        <a href="<?php echo HTTP_SERVER;?>">
            Homepage
        </a> » <strong>Contact us</strong>
    </div>
    
    <div class="box box100p">
        <h1 class="title">
            Contact us</h1>
        <div id="contactInfo">
            <table cellspacing="0" cellpadding="0" border="0" align="center" style="width: 768px;">
        <colgroup><col><col></colgroup>
        <tbody>
            <tr>
                <td valign="top" style="width: 486px;"><strong style="font-size: 11pt;">DZL International</strong></td>
                <td valign="top" style="width: 380px;">&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">&nbsp;&nbsp;&nbsp;Add.: Unit&nbsp; 510, Chamvit Tower</td>
                <td valign="top">Tel.:&nbsp; +84-4-62822118</td>
            </tr>
            <tr>
                <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;117 Tran Duy Hung    St., Cau Giay Dist.</td>
                <td valign="top">Fax.: +84-4-62822119</td>
            </tr>
            <tr>
                <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Hanoi, Vietnam</td>
                <td valign="top">Cell phone: <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; +84-934 56 56 57    (English)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; +84-972 703 901    (Japanese)</td>
            </tr>
            <tr>
                <td valign="top">&nbsp;</td>
                <td valign="top">Email: <a href="mailto:sales@towel.com">sales@towel.com</a></td>
            </tr>
        </tbody>
    </table></div>
        <div style="display:none;" class="RadAjax RadAjax_Vista" id="MainContent_UcContact1_RadAjaxLoadingPanel1">
    	<div class="raDiv">
    
    	</div><div class="raColor raTransp">
    
    	</div>
    </div>
    		<!-- 2013.1.220.40 -->
            
                <div id="divForm">
                <form action="<?php echo HTTP_SERVER . 'index.php?route=contact-us'?>" 
				method="post" enctype="multipart/form-data" id="formContactUs">
                    <ul>
                        <li>
                            Name (*):</li>
                        <li>
                            <input type="text" style="width:300px;" id="MainContent_UcContact1_txtFullName" name="name">&nbsp;
                            <span style="visibility:hidden;" class="spanErr" id="MainContent_UcContact1_rfvFullName">Required</span>
                        </li>
                        <li>
                            Emai (*):</li>
                        <li>
                            <input type="text" style="width:300px;" id="MainContent_UcContact1_txtEmail" name="email">&nbsp;
                            <span style="visibility:hidden;" class="spanErr" id="MainContent_UcContact1_rfvEmail">Required</span><span style="visibility:hidden;" class="spanErr" id="MainContent_UcContact1_revEmail">Invalid Email Format</span>
                        </li>
                        <li>
                            Contact Detail (*):</li>
                        <li style="height: 90px">
                            <textarea style="height:73px;width:309px;" id="MainContent_UcContact1_txtComment" cols="20" rows="2" name="content"></textarea></li>
                        <li>&nbsp;</li>
                        <li>
                            <input type="button" type="submit" onClick="$('#formContactUs').submit();" value="Send">&nbsp;
                            <input type="button" id="MainContent_UcContact1_btnReset" onclick="this.form.reset();return false;WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$MainContent$UcContact1$btnReset&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))" value="Reset" name="ctl00$MainContent$UcContact1$btnReset">
                        </li>
                    </ul>
                    <br>
                    <div class="clear">
                    </div>
                    </form>
                </div>
    	</div>
</div>