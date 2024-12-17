function MultiSelect(id, autoCompleteId) {
    var self = {
        id: id,
        autoCompleteId: autoCompleteId,
        idName: "",
        originalSkills: [],
        skills: [],
        currentSkills: [],
        init: function() {
            $(self.id).attr("type", "hidden");
            self.idName = self.id.substring(1);
            var skills = $(self.id).val().split(';;').map(function (m) { return m.trim(); });
            self.skills = structuredClone(skills);
            self.currentSkills = structuredClone(skills);
            self.originalSkills = structuredClone(skills);
            self.render();
        },
        normalizeId: function(id) {
            return id.replace(/[^A-Z0-9]/ig, "_");
        },
        renderItem: function(item, isActive) {
            if (item !== '') {
                return `<span class="badge ${isActive ? "text-bg-success" : "text-bg-secondary"} pill-rounded mx-1">
                    <a id="${self.normalizeId(self.idName + item)}" class="text-decoration-none text-white pointer">${item}</a>
                </span>`;
            }
            return '';
        },
        render: function() {
            var htmlItems = "";

            self.skills.forEach(function(element) {
                htmlItems += self.renderItem(element, self.currentSkills.includes(element));
            });

            var tmpl = `<div id="${self.idName}New">
                <input id="${self.idName}Input" class="form-control" autocomplete="off">
                <div class="my-2">
                    ${htmlItems}
                </div>
                <div class="d-grid mt-3"><a id="${self.idName}Restore" class="btn btn-danger">Restore</a></div>
            </div>`

            if ($(self.id + "New").length > 0) {
                $(self.id + "New").replaceWith(tmpl);
            } else {
                $(self.id).after(tmpl);
            }
            $(self.id).val(self.currentSkills.join(';;'));

            self.attachActions();
        },
        attachActions: function() {
            $(self.id + "Restore").on('click', self.resetSkills);
            $(self.id + "Input").on('keyup keydown', self.handleInput);
            
            self.skills.forEach(function(item) {
                $("#" + self.normalizeId(self.idName + item)).on('click', function() {
                    self.deleteElement(item);
                });
            })
        },
        deleteElement: function(el) {
            if (self.currentSkills.includes(el)) {
                self.currentSkills = self.currentSkills.filter(function(e) {
                    return e !== el;
                });
            } else {
                console.log('add');
                self.currentSkills.push(el);
            }
            self.render();
        },
        resetSkills: function() {
            self.currentSkills = structuredClone(self.originalSkills);
            self.skills = structuredClone(self.originalSkills);
            self.render();
        },
        handleInput: function(ev) {
            if (ev.key === "Enter") {
                ev.preventDefault();
            }

            var input = $(self.id + "Input");
            if(input.val()?.length > 3) {
                input.attr('list', self.autoCompleteId.substring(1));
            }

            if (ev.type === "keyup") {
                if (ev.key === "Enter") {
                    if (!self.skills.includes(input.val())) {
                        self.skills.push(structuredClone(input.val()));
                        self.currentSkills.push(structuredClone(input.val()));
                        input.val("");
                        self.render();
                        return false;
                    }
                }
            }

            return true;
        },
    }

    return self;
}

// Swipe detector
(function($) {
    $.fn.swipeDetector = function(options) {
      // States: 0 - no swipe, 1 - swipe started, 2 - swipe released
      var swipeState = 0;
      // Coordinates when swipe started
      var startX = 0;
      var startY = 0;
      // Distance of swipe
      var pixelOffsetX = 0;
      var pixelOffsetY = 0;
      // Target element which should detect swipes.
      var swipeTarget = this;
      var defaultSettings = {
        // Amount of pixels, when swipe don't count.
        swipeThreshold: 70,
        // Flag that indicates that plugin should react only on touch events.
        // Not on mouse events too.
        useOnlyTouch: false
      };
  
      // Initializer
      (function init() {
        options = $.extend(defaultSettings, options);
        // Support touch and mouse as well.
        swipeTarget.on("mousedown touchstart", swipeStart);
        $("html").on("mouseup touchend", swipeEnd);
        $("html").on("mousemove touchmove", swiping);
      })();
  
      function swipeStart(event) {
        if (options.useOnlyTouch && !event.originalEvent.touches) return;
  
        if (event.originalEvent.touches) event = event.originalEvent.touches[0];
  
        if (swipeState === 0) {
          swipeState = 1;
          startX = event.clientX;
          startY = event.clientY;
        }
      }
  
      function swipeEnd(event) {
        if (swipeState === 2) {
          swipeState = 0;
  
          if (
            Math.abs(pixelOffsetX) > Math.abs(pixelOffsetY) &&
            Math.abs(pixelOffsetX) > options.swipeThreshold
          ) {
            // Horizontal Swipe
            if (pixelOffsetX < 0) {
              swipeTarget.trigger($.Event("swipeLeft.sd"));
            } else {
              swipeTarget.trigger($.Event("swipeRight.sd"));
            }
          } else if (Math.abs(pixelOffsetY) > options.swipeThreshold) {
            // Vertical swipe
            if (pixelOffsetY < 0) {
              swipeTarget.trigger($.Event("swipeUp.sd"));
            } else {
              swipeTarget.trigger($.Event("swipeDown.sd"));
            }
          }
        }
      }
  
      function swiping(event) {
        // If swipe don't occuring, do nothing.
        if (swipeState !== 1) return;
  
        if (event.originalEvent.touches) {
          event = event.originalEvent.touches[0];
        }
  
        var swipeOffsetX = event.clientX - startX;
        var swipeOffsetY = event.clientY - startY;
  
        if (
          Math.abs(swipeOffsetX) > options.swipeThreshold ||
          Math.abs(swipeOffsetY) > options.swipeThreshold
        ) {
          swipeState = 2;
          pixelOffsetX = swipeOffsetX;
          pixelOffsetY = swipeOffsetY;
        }
      }
  
      return swipeTarget; // Return element available for chaining.
    };
  })(jQuery);