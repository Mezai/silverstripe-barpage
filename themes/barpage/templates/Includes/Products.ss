<div class="product col-sm-6 col-md-4 flip-container">
  <div class="flipper">
      <div class="thumbnail front">
            <% with $Photo.SetSize(400,250) %>
              <img src="$URL" width="$Width" height="$Height" class="group list-group-image">
            <% end_with %>
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                        $Title</h4>
                    <p class="group inner list-group-item-text">
                        $Description.LimitCharacters(300)
                    </p>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="lead">
                                $Price.formatSEK</p>
                        </div>
                   </div>
               </div>
        </div>
        <div class="thumbnail back">
        <div class="caption">
        <h4>$Title</h4>
            <p class="small">$Description</p>
        <h4>Ingredienser</h4>

             $Ingredients
             </div>
        </div>
    </div>
</div>
