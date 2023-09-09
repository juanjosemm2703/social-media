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
