let DetailOfThePosts = document.querySelectorAll(".DetailOfThePost");
let containerOfParamPost = document.querySelectorAll(".PostModifications");

let btnchangingPosts = document.querySelectorAll(".changingPost");
let btndeletingPosts = document.querySelectorAll(".deletingPost");

document.addEventListener('click', (event) => {
    DetailOfThePosts.forEach(DetailOfThePost => {
        let postContainer = DetailOfThePost.closest(".iPost");
        let relatedModifs = postContainer.querySelector(".PostModifications");
        if(!relatedModifs.contains(event.target) && !DetailOfThePost.contains(event.target)){
            setTimeout(() => {relatedModifs.style.display = "none"}, 10);
            relatedModifs.style.opacity = "0";
            relatedModifs.style.transition = "opacity 0.4s";

        }
        if(DetailOfThePost.contains(event.target)){
            console.log(postContainer)
            console.log(relatedModifs);
            if(relatedModifs.style.display !== 'flex'){
                relatedModifs.style.display = "flex";
                setTimeout(() => {relatedModifs.style.opacity= "1"}, 10);
            }
            else{
                relatedModifs.style.opacity = "0";
                setTimeout(() => {relatedModifs.style.display = "none"}, 400);
            }
            console.log(relatedModifs.style.display);
            relatedModifs.style.transition = "opacity 0.4s";
        }
    });
    btndeletingPosts.forEach(btndeletingPost => {
        if(btndeletingPost.contains(event.target)){
            let postContainer = btndeletingPost.closest(".iPost");
            let id_post = Number(postContainer.dataset.id);
            fetch(`/hi/${id_post}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(res => console.log(res))
            .catch(err => console.error(err));

        }
    });
});
