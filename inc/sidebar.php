<script id="sidebar-template" type="text/template">
    <% if(isLoggedIn) { %>
        <div class="<% if(isLoggedIn) { %>isLoggedIn<% } %>">
            <div class="hd">Current Upload</div>
            <div class="upload-group">
                <div class="name">Callie & Zoey</div>
                <div class="date">8/20/89</div>
                <div class="size">1.34Gb</div>
            </div>
        </div>
    <% } %>
</script>
<div class="sidebar-contain"></div>
