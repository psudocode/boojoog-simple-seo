(function ($) {
  "use strict";

  function getContentTab(href) {
    const contentId = href.replace("#", "");
    return "#tab-" + contentId + "-content";
  }
  function registerContentTab(tabId) {
    localStorage.setItem("SSBActiveContentTab", tabId);
  }

  $(document).ready(function () {
    const tabs = $(".nav-tab");
    const contents = $(".tab-content");

    tabs.on("click", function (e) {
      e.preventDefault();

      // Remove active class from all tabs and contents
      tabs.removeClass("nav-tab-active");
      contents.removeClass("active");

      // Add active class to the clicked tab and corresponding content
      $(this).addClass("nav-tab-active");
      const contentTab = getContentTab($(this).attr("href"));
      $(contentTab).addClass("active");
      registerContentTab($(this).attr("href").replace("#", ""));
    });
  });

  //   load active tab from localStorage
  $(document).ready(function () {
    const activeTab = localStorage.getItem("SSBActiveContentTab");
    console.log("Active Tab from LocalStorage:", activeTab);

    if (activeTab) {
      $(".nav-tab").removeClass("nav-tab-active");
      $(".tab-content").removeClass("active");
      $("#tab-" + activeTab).addClass("nav-tab-active");
      $(getContentTab(activeTab)).addClass("active");
    } else {
      // Default to the first tab if no active tab is stored
      $(".nav-tab:first").addClass("nav-tab-active");
      $(".tab-content:first").addClass("active");
      registerContentTab("#tab-general-content");
    }
  });

  // reset localStorage to tab-general if page not ?page=boojoog-seo-settings
  const currentPage = window.location.search;
  if (!currentPage.includes("page=boojoog-simple-seo-settings")) {
    localStorage.setItem("SSBActiveContentTab", "general");
  }

  // handle media upload
  $(document).ready(function () {
    const mediaUploadButtons = $(".boojoog-media-upload-button");
    mediaUploadButtons.on("click", function (e) {
      e.preventDefault();
      const button = $(this);
      const inputField = button.prev("input[type='hidden']");
      const mediaUploader = wp.media({
        title: button.data("title"),
        button: {
          text: button.data("button-text"),
        },
        multiple: false,
      });
      mediaUploader.on("select", function () {
        const attachment = mediaUploader
          .state()
          .get("selection")
          .first()
          .toJSON();
        inputField.val(attachment.url);
        const previewContainer = button.siblings(".preview-container")[0];
        $(previewContainer).empty();
        if (attachment.type === "image") {
          const img = $("<img>").attr("src", attachment.url).css({
            maxWidth: "200px",
            height: "auto",
          });
          $(previewContainer).append(img);
        } else {
          $(previewContainer).text("Selected file: " + attachment.url);
        }
      });
      mediaUploader.open();
    });
    mediaUploadButtons.each(function () {
      const inputField = $(this).prev("input[type='hidden']");
      if (inputField.val()) {
        $(this).text("Change Image");
      } else {
        $(this).text("Upload Image");
      }
    });
  });
})(jQuery);
