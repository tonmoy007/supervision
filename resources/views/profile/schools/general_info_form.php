 <div class="form_view ">
        <div class="form_view_header">
            <%getNumber(1)%> | সাধারণ তথ্য
        </div>
        <div class="form_view_body">
            <table class="table table-responsive table-bordered table-striped">
                <tbody>
                    <tr>
                        <td rowspan="1" colspan="3">শিক্ষাপ্রতিষ্ঠানের নামঃ <label><%profile.user.name%></label></td>
                    </tr>
                    <tr>
                        <td >উপজেলাঃ <%profile.upozilla%></td>
                        <td >জেলাঃ <%profile.zilla%></td>
                        <td>ইআইআইএনঃ <%profile.eiin_number%></td>
                    </tr>
                    <tr>
                        <td >ওয়েবসাইটঃ <%profile.website%></td>
                        <td >ইমেইলঃ <%profile.user.email%></td>
                        <td>ফোনঃ <%profile.phone%></td>
                    </tr>
                    <tr>
                        <td colspan="2">ব্যবস্থাপনাঃ <%profile.management%></td>
                        <td>ধরনঃ <%profile.type%></td>
                    </tr>
                    <tr>
                        <td colspan="2">এম্পিও কোডঃ <%profile.mpo_code%></td>
                        <td>এম্পিওভুক্তির তারিখঃ <%profile.mpo_date%></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>