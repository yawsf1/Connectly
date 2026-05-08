let DetailOfThePosts = document.querySelectorAll(".DetailOfThePost");
let containerOfParamPost = document.querySelectorAll(".PostModifications");

let btnchangingPosts = document.querySelectorAll(".changingPost");
let btndeletingPosts = document.querySelectorAll(".deletingPost");

let confirmDeletePosts = document.querySelectorAll(".confirmDeletePost");
let cancelDeletePosts = document.querySelectorAll(".cancelDeletePost");

let deletePostConfirmations = document.querySelectorAll(
    ".deletePostConfirmation",
);
let deleteAttentionQuestions = document.querySelectorAll(
    ".deleteAttentionQuestion",
);

let closeEditModals = document.querySelectorAll(".closeEditModal");
let confirmEditPosts = document.querySelectorAll(".confirmEditPost");

document.addEventListener("click", (event) => {
    DetailOfThePosts.forEach((DetailOfThePost) => {
        let postContainer = DetailOfThePost.closest(".iPost");
        let relatedModifs = postContainer.querySelector(".PostModifications");
        if (
            !relatedModifs.contains(event.target) &&
            !DetailOfThePost.contains(event.target)
        ) {
            setTimeout(() => {
                relatedModifs.style.display = "none";
            }, 500);
            relatedModifs.style.opacity = "0";
        }
        if (DetailOfThePost.contains(event.target)) {
            console.log(postContainer);
            console.log(relatedModifs);
            if (relatedModifs.style.display !== "flex") {
                relatedModifs.style.display = "flex";
                setTimeout(() => {
                    relatedModifs.style.opacity = "1";
                }, 10);
            } else {
                relatedModifs.style.opacity = "0";
                setTimeout(() => {
                    relatedModifs.style.display = "none";
                }, 500);
            }
        }
        relatedModifs.style.transition = "opacity 0.4s";
    });
    btndeletingPosts.forEach((btndeletingPost) => {
        let postContainerAll = btndeletingPost.closest(".iPost");
        let deletePostConfirmation = postContainerAll.querySelector(
            ".deletePostConfirmation",
        );
        let PostModifications =
            postContainerAll.querySelector(".PostModifications");
        if (
            !btndeletingPost.contains(event.target) &&
            !deletePostConfirmation.contains(event.target)
        ) {
            setTimeout(() => {
                deletePostConfirmation.style.display = "none";
            }, 550);
            deletePostConfirmation.style.opacity = "0";
        }
        if (btndeletingPost.contains(event.target)) {
            if (deletePostConfirmation.style.display !== "flex") {
                deletePostConfirmation.style.display = "flex";
                setTimeout(() => {
                    deletePostConfirmation.style.opacity = "1";
                }, 10);
            } else {
                setTimeout(() => {
                    deletePostConfirmation.style.display = "none";
                }, 500);
                deletePostConfirmation.style.opacity = "0";
            }
            setTimeout(() => (PostModifications.style.display = "none"), 450);
            PostModifications.style.opacity = "0";
        }
        deletePostConfirmation.style.transition = "opacity 0.4s";
        PostModifications.style.transition = "opacity 0.4s";
    });

    deleteAttentionQuestions.forEach((deleteAttentionQuestionn) => {
        let wholeConfirmationn = deleteAttentionQuestionn.closest(
            ".deletePostConfirmation",
        );
        if (deleteAttentionQuestionn.contains(event.target)) {
            if (wholeConfirmationn.style.display !== "flex") {
                wholeConfirmationn.style.display = "flex";
                setTimeout(() => {
                    wholeConfirmationn.style.opacity = "1";
                }, 10);
            } else {
                setTimeout(() => {
                    wholeConfirmationn.style.display = "none";
                }, 500);
                wholeConfirmationn.style.opacity = "0";
            }
            wholeConfirmationn.style.transition = "opacity 0.4s";
        }
    });
    cancelDeletePosts.forEach((cancelDeletePost) => {
        let wholeConfirmationn = cancelDeletePost.closest(
            ".deletePostConfirmation",
        );
        if (cancelDeletePost.contains(event.target)) {
            if (wholeConfirmationn.style.display !== "flex") {
                wholeConfirmationn.style.display = "flex";
                setTimeout(() => {
                    wholeConfirmationn.style.opacity = "1";
                }, 10);
            } else {
                setTimeout(() => {
                    wholeConfirmationn.style.display = "none";
                }, 500);
                wholeConfirmationn.style.opacity = "0";
            }
            wholeConfirmationn.style.transition = "opacity 0.4s";
        }
    });

    confirmDeletePosts.forEach((confirmDeletePost) => {
        let wholePost = confirmDeletePost.closest(".iPost");
        let id_post = wholePost.dataset.id;

        if (confirmDeletePost.contains(event.target)) {
            fetch(`/api/posts/${id_post}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((res) => res.json())
                .then((res) => {
                    console.log(res);
                    setTimeout(() => {
                        wholePost.style.display = "none";
                    }, 500);
                    wholePost.style.opacity = "0";
                    wholePost.style.transition = "opacity 0.5s";
                })
                .catch((err) => console.error(err));
        }
    });

    btnchangingPosts.forEach((btnchangingPost) => {
        let postContainerAll = btnchangingPost.closest(".iPost");
        let editPostModal = postContainerAll.querySelector(".editPostModal");
        let PostModifications =
            postContainerAll.querySelector(".PostModifications");
        let currentContent =
            postContainerAll.querySelector(".contentOfPost").innerText;
        let textarea = editPostModal.querySelector(".editPostTextarea");

        if (
            !btnchangingPost.contains(event.target) &&
            !editPostModal.contains(event.target)
        ) {
            setTimeout(() => {
                editPostModal.style.display = "none";
            }, 550);
            editPostModal.style.opacity = "0";
        }
        if (btnchangingPost.contains(event.target)) {
            if (editPostModal.style.display !== "flex") {
                textarea.value = currentContent;
                editPostModal.style.display = "flex";
                setTimeout(() => {
                    editPostModal.style.opacity = "1";
                }, 10);
            } else {
                setTimeout(() => {
                    editPostModal.style.display = "none";
                }, 500);
                editPostModal.style.opacity = "0";
            }
            setTimeout(() => (PostModifications.style.display = "none"), 450);
            PostModifications.style.opacity = "0";
        }
        editPostModal.style.transition = "opacity 0.4s";
        PostModifications.style.transition = "opacity 0.4s";
    });

    closeEditModals.forEach((closeEditModal) => {
        let wholeModal = closeEditModal.closest(".editPostModal");
        if (closeEditModal.contains(event.target)) {
            if (wholeModal.style.display !== "flex") {
                wholeModal.style.display = "flex";
                setTimeout(() => {
                    wholeModal.style.opacity = "1";
                }, 10);
            } else {
                setTimeout(() => {
                    wholeModal.style.display = "none";
                }, 500);
                wholeModal.style.opacity = "0";
            }
            wholeModal.style.transition = "opacity 0.4s";
        }
    });

    confirmEditPosts.forEach((confirmEditPost) => {
        let wholePost = confirmEditPost.closest(".iPost");
        let id_post = wholePost.dataset.id;
        let editPostModal = wholePost.querySelector(".editPostModal");
        let textarea = editPostModal.querySelector(".editPostTextarea");
        let contentDisplay = wholePost.querySelector(".contentOfPost");

        if (confirmEditPost.contains(event.target)) {
            let newContent = textarea.value;
            fetch(`/api/posts/${id_post}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ content: newContent }),
            })
                .then((res) => res.json())
                .then((res) => {
                    contentDisplay.innerText = newContent;
                    setTimeout(() => {
                        editPostModal.style.display = "none";
                    }, 500);
                    editPostModal.style.opacity = "0";
                    editPostModal.style.transition = "opacity 0.5s";
                })
                .catch((err) => console.error(err));
        }
    });
});
