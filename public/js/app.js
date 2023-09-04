var hideComments = document.querySelectorAll(".hide");
hideComments.forEach(function (hideComments) {
    hideComments.addEventListener("click", function () {
    const comment = this.parentNode;
    console.log(comment)
    const replies = Array.from(comment.children).filter(child => child.nodeType === 1 && child.classList.contains('reply')) ;
    replies.forEach(function (replies) {
        replies.classList.toggle("hidden");
    });
  });
});

