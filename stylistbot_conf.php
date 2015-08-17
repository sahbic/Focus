<?php
	include_once "common/base.php";
	$pageTitle = "StylistBot Configuration";
	include_once "common/header.php";
?>

        <div class="bs-example">
          <form class="form-horizontal" role="form" id="addClothesForm" method="post" action="process.php">
            <div class="form-group">
              <label for="ID" class="control-label col-xs-2">ID</label>
              <div class="col-xs-10">
                <input type="text" class="form-control" id="ID" name="ID" placeholder="ID" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="Type" class="control-label col-xs-2">Type</label>
              <div class="col-xs-10">
                <label class="radio-inline"><input type="radio" name="Type" value="Top">Top</label>
                <label class="radio-inline"><input type="radio" name="Type" value="Bottom">Bottom</label>
                <label class="radio-inline"><input type="radio" name="Type" value="Full">Full</label>
              </div>
            </div>
            <div class="form-group">
              <label for="ItemColor" class="control-label col-xs-2">Color</label>
              <div class="col-xs-10">
                <div class="input-group colorpicker-component">
                  <input type="text" id="ItemColor" name="ItemColor" placeholder="#000000" class="form-control" value="#000000"/>
                  <span class="input-group-addon"><i></i></span>
                </div>
              </div>
            </div>
            <br/>
            <div class="form-group">
              <label for="Features" class="control-label col-xs-2">Features</label>
              <div class="col-xs-10">
                <p class="featureSlider">
                  <b class="leftLabel">Thin</b>
                  <input id="Thickness" name="Thickness" value="" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
                  <b class="rightLabel">Thick</b>
                </p>
                <br/>
                <p class="featureSlider">
                  <b class="leftLabel">Casual</b>
                  <input id="Formality" name="Formality" value="" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
                  <b class="rightLabel">Formal</b>
                </p>
                <br/>
                <p class="featureSlider">
                  <b class="leftLabel">Short</b>
                  <input id="Length" name="Length" value="" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
                  <b class="rightLabel">Long</b>
                </p>
                <br/>
                <p class="featureSlider">
                  <b class="leftLabel">Unattractive</b>
                  <input id="Attractiveness" name="Attractiveness" value="" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
                  <b class="rightLabel">Attractive</b>
                </p>
                <br/>
                <p class="featureSlider">
                  <b class="leftLabel">Slim fit</b>
                  <input id="Fitness" name="Fitness" value="" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
                  <b class="rightLabel">Large</b>
                </p>
              </div>
            </div>
            <br/>
            <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                <!-- <button type="button" class="btn btn-primary" onclick="addToFile();">Add element</button> -->
                <button type="submit" class="btn btn-primary">Add element</button>
              </div>
            </div>
          </form>
        </div>

<?php
	include_once 'common/close.php';
?>
