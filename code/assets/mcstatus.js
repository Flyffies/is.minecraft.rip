(function(win) {
    var currentVersion = 10,

        $ = win.jQuery,

        secondsToUpdate = 0,

        storage = win.localStorage,

        announcementElement = $('#announcement'),
        secondsElement = $('#time-to-update'),
        lastUpdateElement = $('#last-update'),

        prevCheckDown = false,
        loadState = 0,

        statusElements = {
            login: $('#login'),
            website: $('#website'),
            session: $('#session'),
            skins: $('#skins'),
            realms: $('#realms')
        },

        tick = function() {
            if (secondsToUpdate <= 0) {
                secondsToUpdate = 31;

                $.ajax({
                    url: 'status.json',
                    dataType: 'json',
                    error: handleError,
                    success: updateStatus
                });
            } else {
                secondsToUpdate -= 1;

                secondsElement.text(secondsToUpdate < 10 ? '0' + secondsToUpdate : secondsToUpdate);

                setTimeout(tick, 1000);
            }
        },

        handleError = function() {
            if (!loadState) {
                announcementElement.html('Failed to get current status, please try again later.').show();

                $.each(statusElements, function(name, element) {
                    element.find('.status').text('Failed');
                });
            }

            tick();
        },

        updateStatus = function(json) {
            var element, downNow = false;

            $.each(json.report, function(service, status) {
                element = statusElements[service];

                if (element) {
                    if (!element.hasClass(status.status)) {
                        element.removeClass('problem down up').addClass(status.status);
                    }

                    element.find('.status').text(status.title);
                    element = element.find('.uptime').text(status.downtime ? 'Down for ' + status.downtime + 'm' : '\xa0');

                    if (status.status === 'down') {
                        downNow = true;
                    }
                }
            });

            lastUpdateElement.text(json.last_updated);

            if (json.v && json.v !== currentVersion) {
                element = '<span class="light-blue">Warning!</span> Refresh this page to receive latest version.';

                json.psa = json.psa ? element + '<hr class="dotted">' + json.psa : element;
            }

            if (json.psa) {
                announcementElement.html(json.psa).show();
            } else if (announcementElement.is(':visible')) {
                announcementElement.hide();
            }

            tick();

            if (downNow) {
                prevCheckDown = true;
            } else if (prevCheckDown) {
                prevCheckDown = false;
            }

            loadState = 1;
        }

    // Start the app
    tick();

    // Remove utm_ params
    if (win.history && win.history.replaceState && win.location.search.match(/utm_/)) {
        win._gaq.push(function() {
            win.history.replaceState({}, "", win.location.pathname);
        });
    }

    // Delete noscript element, workaround IE bug
    $('noscript').remove();
}(window));