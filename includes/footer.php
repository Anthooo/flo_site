<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/main.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/AnimOnScroll.js"></script>
<script>
	new AnimOnScroll( document.getElementById( 'grid' ), {
		minDuration : 0.4,
		maxDuration : 0.7,
		viewportFactor : 0.2
	} );
</script>

<script>
	(function() {
		var support = { transitions: Modernizr.csstransitions },
			// transition end event name
			transEndEventNames = { 'WebkitTransition': 'webkitTransitionEnd', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'msTransition': 'MSTransitionEnd', 'transition': 'transitionend' },
			transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
			onEndTransition = function( el, callback ) {
				var onEndCallbackFn = function( ev ) {
					if( support.transitions ) {
						if( ev.target != this ) return;
						this.removeEventListener( transEndEventName, onEndCallbackFn );
					}
					if( callback && typeof callback === 'function' ) { callback.call(this); }
				};
				if( support.transitions ) {
					el.addEventListener( transEndEventName, onEndCallbackFn );
				}
				else {
					onEndCallbackFn();
				}
			};

		new GridFx(document.querySelector('.grid'), {
			imgPosition : {
				x : -0.5,
				y : 1
			},
			onOpenItem : function(instance, item) {
				instance.items.forEach(function(el) {
					if(item != el) {
						var delay = Math.floor(Math.random() * 50);
						el.style.WebkitTransition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), -webkit-transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
						el.style.transition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
						el.style.WebkitTransform = 'scale3d(0.1,0.1,1)';
						el.style.transform = 'scale3d(0.1,0.1,1)';
						el.style.opacity = 0;
					}
				});
			},
			onCloseItem : function(instance, item) {
				instance.items.forEach(function(el) {
					if(item != el) {
						el.style.WebkitTransition = 'opacity .4s, -webkit-transform .4s';
						el.style.transition = 'opacity .4s, transform .4s';
						el.style.WebkitTransform = 'scale3d(1,1,1)';
						el.style.transform = 'scale3d(1,1,1)';
						el.style.opacity = 1;

						onEndTransition(el, function() {
							el.style.transition = 'none';
							el.style.WebkitTransform = 'none';
						});
					}
				});
			}
		});
	})();
</script>
<script>
	$('.button-collapse').sideNav({
		menuWidth: 300, // Default is 240
		edge: 'right', // Choose the horizontal origin
		closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
		}
	);
</script>
<script>
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
    $('.parallax').parallax();
  });
</script>

</body>

</html>
