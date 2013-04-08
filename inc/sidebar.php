<script id="sidebar-template" type="text/template">
    <% if(isLoggedIn) { %>
        <div class="<% if(isLoggedIn) { %>isLoggedIn<% } %>">
            Current Upload
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th># Files</th>
                        <th>Size</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Upload ch...</td>
                        <td>3</td>
                        <td>23Mb</td>
                    </tr>
                </tbody>
            </table>
        </div>
    <% } %>
</script>
<div class="sidebar-contain"></div>
