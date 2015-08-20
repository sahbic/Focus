          <div class="mastfoot">
            <div class="inner">
              <p>© 2015 Focus</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-slider.js"></script>
    <script src="js/bootstrap-colorpicker.js"></script>
    <script>
    $(function(){
    $('.colorpicker-component').colorpicker();
    $('#Thickness').slider({
      ticks: [0,25, 50,75, 100],
      value: 50,
      step: 25,
      tooltip: 'hide'
  });
    $('#Formality').slider({
      ticks: [0,25, 50,75, 100],
      value: 50,
      step: 25,
      tooltip: 'hide'
  });
    $('#Length').slider({
      ticks: [0, 50, 100],
      value: 50,
      step: 50,
      tooltip: 'hide'
  });
    $('#Attractiveness').slider({
      ticks: [0,25, 50,75, 100],
      value: 50,
      step: 25,
      tooltip: 'hide'
  });
    $('#Fitness').slider({
      ticks: [0,25, 50,75, 100],
      value: 50,
      step: 25,
      tooltip: 'hide'
  });
    });
    </script>
  </body>
</html>
