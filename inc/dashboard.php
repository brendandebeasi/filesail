<script id="dashboard-template" type="text/template">
    <div class="dashboard-contain<% if(isLoggedIn) { %> isLoggedIn<% } %>">
        <div class="hd">

        </div>
        <div class="bd">

        </div>
    </div>
</script>
<script id="dashboard-cell-template" type="text/template">
    <% if(model.get('type') == 'img') { %>
    <div style="background-image:url(<%= model.getDownloadLink() %>);background-size:cover;background-position:center center;background-repeat: no-repeat;" class="wrp-1">
    <% } %>
</script>