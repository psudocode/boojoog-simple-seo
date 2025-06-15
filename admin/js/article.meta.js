jQuery(document).ready(function ($) {
  function extractArticleMetadata(text) {
    const cleanText = text.trim();
    const words = cleanText.match(/\b\w+\b/g) || [];
    const sentences = cleanText.match(/[^.!?]+[.!?]+/g) || [];
    const paragraphs = cleanText
      .split(/\n{2,}/)
      .filter((p) => p.trim().length > 0);
    const charactersWithSpaces = cleanText.length;
    const charactersWithoutSpaces = cleanText.replace(/\s/g, "").length;

    const uniqueWords = [...new Set(words.map((w) => w.toLowerCase()))];

    const averageWordLength = words.length
      ? (charactersWithoutSpaces / words.length).toFixed(2)
      : 0;

    const averageSentenceLength = sentences.length
      ? (words.length / sentences.length).toFixed(2)
      : 0;

    const readingTimeMinutes = Math.ceil(words.length / 200); // avg 200 wpm

    // Naive keyword frequency (top 5)
    const frequencyMap = {};
    words.forEach((word) => {
      const lower = word.toLowerCase();
      frequencyMap[lower] = (frequencyMap[lower] || 0) + 1;
    });

    const sortedKeywords = Object.entries(frequencyMap)
      .filter(([word]) => word.length > 3) // filter short/common words
      .sort((a, b) => b[1] - a[1])
      .slice(0, 5)
      .map(([word]) => word);

    return {
      wordCount: words.length,
      characterCount: {
        withSpaces: charactersWithSpaces,
        withoutSpaces: charactersWithoutSpaces,
      },
      sentenceCount: sentences.length,
      paragraphCount: paragraphs.length,
      averageWordLength,
      averageSentenceLength,
      readingTimeMinutes,
      uniqueWordCount: uniqueWords.length,
      vocabularyRichness: (uniqueWords.length / words.length).toFixed(2),
      topKeywords: sortedKeywords,
    };
  }

  // Make the function available globally if needed
  window.extractArticleMetadata = extractArticleMetadata;

  function getPostContent() {
    var content = "";

    // Try Gutenberg first
    if (typeof wp !== "undefined" && wp.data && wp.data.select) {
      var editorStore = wp.data.select("core/editor");
      if (editorStore) {
        content = editorStore.getEditedPostContent();
        if (content) return content;
      }
    }

    // Try TinyMCE
    if (typeof tinyMCE !== "undefined" && tinyMCE.get("content")) {
      content = tinyMCE.get("content").getContent();
      if (content) return content;
    }

    // Fallback to textarea
    var contentTextarea = document.getElementById("content");
    if (contentTextarea && contentTextarea.value) {
      return contentTextarea.value;
    }

    return "";
  }

  function waitForEditor(callback) {
    const checkEditor = setInterval(() => {
      let metadata = {};
      let content = getPostContent();
      if (content) {
        content = content.replace(/<!-- wp:paragraph -->/g, "");
        content = content.replace(/<!-- \/wp:paragraph -->/g, "");
        metadata = extractArticleMetadata(content);
        clearInterval(checkEditor);
        callback(metadata);
      }
    }, 1000);

    // Stop checking after 3 seconds to avoid infinite loop
    setTimeout(() => {
      clearInterval(checkEditor);
    }, 3000);
  }

  function wordCountProgress() {
    const $wordCountItem = $('.bss-summary-item[data-metric="word-count"]');
    if ($wordCountItem.length) {
      const currentWordCount = parseInt($wordCountItem.data("count")) || 0;
      updateProgress(currentWordCount, [100, 200, 300, 500], $wordCountItem[0]);
    }
  }

  function characterCountProgress() {
    const $characterCountItem = $(
      '.bss-summary-item[data-metric="character-count"]'
    );
    if ($characterCountItem.length) {
      const currentCharacterCount =
        parseInt($characterCountItem.data("count")) || 0;
      updateProgress(
        currentCharacterCount,
        [500, 1000, 1500, 2000],
        $characterCountItem[0]
      );
    }
  }
  function sentenceCountProgress() {
    const $sentenceCountItem = $(
      '.bss-summary-item[data-metric="sentence-count"]'
    );
    if ($sentenceCountItem.length) {
      const currentSentenceCount =
        parseInt($sentenceCountItem.data("count")) || 0;
      updateProgress(
        currentSentenceCount,
        [10, 20, 30, 50],
        $sentenceCountItem[0]
      );
    }
  }
  function paragraphCountProgress() {
    const $paragraphCountItem = $(
      '.bss-summary-item[data-metric="paragraph-count"]'
    );
    if ($paragraphCountItem.length) {
      const currentParagraphCount =
        parseInt($paragraphCountItem.data("count")) || 0;
      updateProgress(
        currentParagraphCount,
        [2, 4, 6, 8],
        $paragraphCountItem[0]
      );
    }
  }
  function averageWordLengthProgress() {
    const $averageWordLengthItem = $(
      '.bss-summary-item[data-metric="average-word-length"]'
    );
    if ($averageWordLengthItem.length) {
      const currentAverageWordLength =
        parseFloat($averageWordLengthItem.data("count")) || 0;
      updateProgress(
        currentAverageWordLength,
        [4, 5, 6, 7],
        $averageWordLengthItem[0]
      );
    }
  }
  function averageSentenceLengthProgress() {
    const $averageSentenceLengthItem = $(
      '.bss-summary-item[data-metric="average-sentence-length"]'
    );
    if ($averageSentenceLengthItem.length) {
      const currentAverageSentenceLength =
        parseFloat($averageSentenceLengthItem.data("count")) || 0;
      updateProgress(
        currentAverageSentenceLength,
        [10, 15, 20, 25],
        $averageSentenceLengthItem[0]
      );
    }
  }
  function readingTimeProgress() {
    const $readingTimeItem = $('.bss-summary-item[data-metric="reading-time"]');
    if ($readingTimeItem.length) {
      const currentReadingTime = parseInt($readingTimeItem.data("count")) || 0;
      updateProgress(currentReadingTime, [1, 2, 3, 5], $readingTimeItem[0]);
    }
  }
  function uniqueWordCountProgress() {
    const $uniqueWordCountItem = $(
      '.bss-summary-item[data-metric="unique-word-count"]'
    );
    if ($uniqueWordCountItem.length) {
      const currentUniqueWordCount =
        parseInt($uniqueWordCountItem.data("count")) || 0;
      updateProgress(
        currentUniqueWordCount,
        [50, 100, 150, 200],
        $uniqueWordCountItem[0]
      );
    }
  }
  function vocabularyRichnessProgress() {
    const $vocabularyRichnessItem = $(
      '.bss-summary-item[data-metric="vocabulary-richness"]'
    );
    if ($vocabularyRichnessItem.length) {
      const currentVocabularyRichness =
        parseFloat($vocabularyRichnessItem.data("count")) || 0;
      updateProgress(
        currentVocabularyRichness,
        [0.1, 0.2, 0.3, 0.4],
        $vocabularyRichnessItem[0]
      );
    }
  }

  function updateProgress(value, range, element) {
    element.classList.remove("state-bad", "state-normal", "state-good");
    if (value < range[0]) {
      element.classList.add("state-bad");
    } else if (value >= range[0] && value <= range[1]) {
      element.classList.add("state-normal");
    } else {
      element.classList.add("state-good");
    }
  }

  //   create article summaries with extractArticleMetadata and add to placeholder
  function createArticleSummaries() {
    let placeholder = $("#bss-summaries");
    let editorCheckInterval = setInterval(function () {
      waitForEditor((metadata) => {
        placeholder.html(""); // Clear previous summaries
        let summaryHtml = `
            <div class="bss-summary">
              <div class="bss-summary-item" data-metric="word-count" data-count="${
                metadata.wordCount
              }">${metadata.wordCount} words total</div>
              <div class="bss-summary-item" data-metric="character-count" data-count="${
                metadata.characterCount.withoutSpaces
              }">${metadata.characterCount.withoutSpaces} characters</div>
              <div class="bss-summary-item" data-metric="sentence-count" data-count="${
                metadata.sentenceCount
              }">${metadata.sentenceCount} sentences</div>
              <div class="bss-summary-item" data-metric="paragraph-count" data-count="${
                metadata.paragraphCount
              }">${metadata.paragraphCount} paragraphs</div>
              <div class="bss-summary-item" data-metric="average-word-length" data-count="${
                metadata.averageWordLength
              }">Average word length ${
          metadata.averageWordLength
        } characters</div>
              <div class="bss-summary-item" data-metric="average-sentence-length" data-count="${
                metadata.averageSentenceLength
              }">Average sentence length : ${
          metadata.averageSentenceLength
        } words </div>
              <div class="bss-summary-item" data-metric="reading-time" data-count="${
                metadata.readingTimeMinutes
              }">${metadata.readingTimeMinutes} minutes reading time</div>
              <div class="bss-summary-item" data-metric="unique-word-count" data-count="${
                metadata.uniqueWordCount
              }">${metadata.uniqueWordCount} unique words</div>
              <div class="bss-summary-item" data-metric="vocabulary-richness" data-count="${
                metadata.vocabularyRichness
              }">vocabulary richness : ${metadata.vocabularyRichness}</div>
              <div class="bss-summary-item" data-metric="top-keywords">Top Keywords: ${metadata.topKeywords.join(
                ", "
              )}</div>
            </div>`;

        placeholder.append(summaryHtml);

        wordCountProgress();
        characterCountProgress();
        sentenceCountProgress();
        paragraphCountProgress();
        averageWordLengthProgress();
        averageSentenceLengthProgress();
        readingTimeProgress();
        uniqueWordCountProgress();
        vocabularyRichnessProgress();
      });
    }, 3000);

    // Stop checking after 1 hour to avoid infinite loop
    setTimeout(() => {
      clearInterval(editorCheckInterval);
      console.warn("Editor content not found within 1 hour.");
    }, 3600000);
  }

  // Call the function to create summaries
  createArticleSummaries();
});
