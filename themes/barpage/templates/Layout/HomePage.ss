<div class="well well-sm">
		$productSearchForm
	</div>
     <div id="products" class="row list-group">
    <% if $Results %>
        <% loop $Results %>
            <% include Products %>
        <% end_loop %>
        <% else %>
        <!-- show all -->
          <% loop Products %>
          <% include Products %>
        <% end_loop %>
        <% end_if %>
</div>