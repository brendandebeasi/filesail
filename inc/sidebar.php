<script id="sidebar-template" type="text/template">
    <% if(isLoggedIn) { %>
        <div class="<% if(isLoggedIn) { %>isLoggedIn<% } %>">
            <div class="hd">
                <div class="title left">Your Files</div>
                <div class="icon gear right">O</div>
                <div class="clear"></div>
            </div>
            <table class="uploads">
                <thead>
                    <tr>
                        <th class="name">Name</th>
                        <th class="num"># Files</th>
                        <th class="date">Date</th>
                        <th class="size">Size</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="name">Callie and Zoey </td>
                        <td class="num">22</td>
                        <td class="date">08/20/13</td>
                        <td class="size">1.27GB</td>
                    </tr>
                    <tr>
                        <td class="name">Matt & Danielle </td>
                        <td class="num">122</td>
                        <td class="date">11/20/13</td>
                        <td class="size">19.27GB</td>
                    </tr>
                    <tr>
                        <td class="name">Brendan & Chrissi </td>
                        <td class="num">1,222</td>
                        <td class="date">3/3/11</td>
                        <td class="size">119.27GB</td>
                    </tr>
                </tbody>
            </table>
        </div>
    <% } %>
</script>
<div class="sidebar-contain"></div>
