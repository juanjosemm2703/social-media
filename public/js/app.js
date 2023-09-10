/**
 * Function to toggle the visibility of elements within a specific class.
 * parameter: hiddenClass - The class name of elements to be hidden or shown.
 * parameter: toggleButtonClass - The class name of the toggle buttons that trigger the visibility change.
 */

function hideShow(hiddenClass, toogleButtonClass){
var hideComments = document.querySelectorAll(`.${toogleButtonClass}`);
hideComments.forEach(function (hideComments) {
    hideComments.addEventListener("click", function () {
    const comment = this.parentNode;
    const replies = Array.from(comment.children).filter(child => child.nodeType === 1 && child.classList.contains(hiddenClass)) ;
    replies.forEach(function (replies) {
        replies.classList.toggle("hidden");
    });
  });
});
};

hideShow('reply','hide-replies');
hideShow('post-card__comments-footer','hide-replyForm');
