/*
 * timeout-dialog.js v2.0.0, 10-19-2014
 *
 * @original-author: Rodrigo Neri (@rigoneri)
 *
 * (The MIT License)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/* String formatting, you might want to remove this if you already use it.
 * Example:
 *
 * var location = 'World';
 * alert('Hello {0}'.format(location));
 */
String.prototype.format = function () {
  var s = this,
    i = arguments.length;

  while (i--) {
    s = s.replace(new RegExp("\\{" + i + "\\}", "gm"), arguments[i]);
  }
  return s;
};

!(function ($) {
  $.timeoutDialog = {
    settings: {
      timeout: 2, //minute
      countdown: 1, //minute
      check_session_expire_time: 10, // second
      title: "Session ของคุณกำลังจะหมดอายุ!",
      message: "Session กำลังจะหมดอายุภายใน {0}",
      question: "คุณต้องการใช้งานต่อหรือไม่?",
      message_session_expire:
        "Session ของคุณหมดอายุแล้ว โปรดเข้าสู่ระบบเพื่อใช้งานต่อไป",
      keep_alive_button_text: "ใช่, ดำเนินการต่อ",
      sign_out_button_text: "ไม่, ออกจากระบบ",
      keep_alive_url: "",
      keep_alive_function: function () {},
      logout_url: null,
      logout_redirect_url: "/",
      check_session_expire_url: "",
      logout_function: function () {},
      restart_on_yes: true,
      dialog_width: 350,
    },
    alertSetTimeoutHandle: 0,
    checkSessionExpireIntervalId: 0,
    isCountdownActive: false,
    isSessionExpire: false,
    setupDialogTimer: function (options) {
      if (options !== undefined) {
        $.extend(this.settings, options);
      }

      var self = this;

      if (self.alertSetTimeoutHandle !== 0) {
        clearTimeout(self.alertSetTimeoutHandle);
      }

      self.alertSetTimeoutHandle = window.setTimeout(function () {
        if (!self.isSessionExpire) {
          self.setupDialog();
        }
      }, (this.settings.timeout * 60 - this.settings.countdown * 60) * 1000);

      self.isCountdownActive = false;
    },
    setupDialog: function () {
      var self = this;
      self.destroyDialog();

      //$('<div id="timeout-dialog">' +
      //		'<p id="timeout-message">' + this.settings.message.format('<span id="timeout-countdown">' + this.settings.countdown + '</span>') + '</p>' +
      //		'<p id="timeout-question">' + this.settings.question + '</p>' +
      //		'</div>')
      //		.appendTo('body')
      bootbox.dialog({
        message:
          '<p id="timeout-message">' +
          this.settings.message.format(
            '<span id="timeout-countdown">' +
              this.settings.countdown +
              " นาที.</span>"
          ) +
          "</p>" +
          '<p id="timeout-question">' +
          this.settings.question +
          "</p>",
        //modal: true,
        //width: this.settings.dialog_width,
        //minHeight: 'auto',
        //zIndex: 10000,
        //closeOnEscape: false,
        //draggable: false,
        //resizable: false,
        //dialogClass: 'timeout-dialog',
        title: this.settings.title,
        buttons: {
          ok: {
            label: this.settings.keep_alive_button_text,
            className: "timeout-keep-signin-btn",
            callback: function () {
              self.keepAlive();
            },
            //click: function () {
            //    self.keepAlive();
            //}
          },
          cancel: {
            label: this.settings.sign_out_button_text,
            className: "timeout-sign-out-button",
            callback: function () {
              self.signOut(true);
            },
            //click: function () {
            //    self.signOut(true);
            //}
          },
        },
      });

      self.startCountdown();
      self.isCountdownActive = true;
    },
    destroyDialog: function () {
      if ($("#timeout-dialog").length) {
        //$("#timeout-dialog").dialog("close");
        $("#timeout-dialog").hide();
        $("#timeout-dialog").remove();
      }
    },
    startCountdown: function () {
      var self = this,
        counter = this.settings.countdown * 60;

      this.countdown = window.setInterval(function () {
        counter -= 1;
        let minutes = Math.floor(counter / 60);
        let seconds = counter % 60;
        let showMess = "";

        if (minutes !== 0) {
          showMess = minutes + " นาที";
        }

        if (seconds !== 0) {
          showMess += " " + seconds + " วินาที";
        }

        showMess += ".";

        $("#timeout-countdown").html(showMess);

        if (counter <= 0) {
          window.clearInterval(self.countdown);
          self.signOut(false);
        }
      }, 1000);
    },
    keepAlive: function () {
      var self = this;
      this.destroyDialog();

      window.clearInterval(this.countdown);

      this.settings.keep_alive_function();

      if (this.settings.keep_alive_url !== "") {
        $.get(this.settings.keep_alive_url, function (data) {
          if (data === "OK") {
            if (self.settings.restart_on_yes) {
              self.isSessionExpire = false;
              self.setupDialogTimer();
            }
          } else {
            self.signOut(false);
          }
        });
      }
    },
    signOut: function (is_forced) {
      var self = this;
      this.destroyDialog();

      this.settings.logout_function(is_forced);

      if (this.settings.logout_url !== null) {
        $.post(this.settings.logout_url, function (data) {
          self.redirectLogout(is_forced);
        });
      } else {
        self.redirectLogout(is_forced);
      }
    },
    redirectLogout: function (is_forced) {
      var target =
        this.settings.logout_redirect_url +
        "?next=" +
        encodeURIComponent(window.location.pathname + window.location.search);
      if (!is_forced) target += "&timeout=t";
      window.location = target;
    },
    startCheckSessionExpireInterval: function () {
      var self = this;

      self.checkSessionExpireIntervalId = setInterval(function () {
        self.checkSessionExpire();
        if (self.isSessionExpire) {
          self.stopCheckSessionExpireInterval();
        }
      }, self.settings.check_session_expire_time * 1000);

      return self.checkSessionExpireIntervalId;
    },
    stopCheckSessionExpireInterval: function () {
      var self = this;
      clearInterval(self.checkSessionExpireIntervalId);
      self.checkSessionExpireIntervalId = 0;
    },
    checkSessionExpire: function () {
      var self = this;

      // Skip if session expired or no check session url
      if (self.isSessionExpire || self.settings.check_session_expire_url == "")
        return;

      $.ajax({
        url: self.settings.check_session_expire_url,
        type: "post",
        dataType: "json",
        success: function (result) {
          if (result == false) {
            self.isSessionExpire = true;

            // Clear Countdown modal
            $("#timeout-countdown").closest(".bootbox").modal("hide");
            window.clearInterval(self.countdown);

            globalFunction.alert({
              type: "warning",
              message: self.settings.message_session_expire,
              closeButton: false,
              callback: function () {
                self.redirectLogout(true);
              },
            });
          }
        },
      });
    },
  };
})(window.jQuery);
