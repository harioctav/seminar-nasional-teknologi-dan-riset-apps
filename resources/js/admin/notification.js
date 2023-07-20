$(() => {
    loadNotification();
    // setInterval(loadNotification, 5000);
});

let currentPage = 1;
const itemsPerPage = 5;

const loadNotification = async () => {
    let unreadCount = parseInt($(".notifications-count").text()) || 0;
    try {
        const response = await $.ajax({
            url: "/notifications",
            type: "GET",
            dataType: "json",
        });

        const notificationList = $("#notifications-list");
        notificationList.empty();

        if (response.length > 0) {
            response.forEach((notification) => {
                const listItem = $("<li></li>");
                const anchorTag = $(
                    '<a class="text-dark d-flex py-2" href="javascript:void(0)"></a>'
                );

                if (!notification.read_at) {
                    unreadCount++;
                }

                anchorTag.click(async function () {
                    await markNotificationAsRead(notification.id, anchorTag);

                    if (!notification.read_at) {
                        unreadCount--;
                    }
                    $(".notifications-count").text(unreadCount);
                    $(this).find(".fw-semibold").removeClass("fw-semibold");
                });

                const icon = $(
                    '<div class="flex-shrink-0 me-2 ms-3"><i class="fa fa-fw fa-bell text-success"></i></div>'
                );
                const content = $(
                    `<div class="flex-grow-1 pe-2"><div class="${
                        notification.read_at ? "" : "fw-semibold"
                    }">${notification.data.message}</div></div>`
                );

                anchorTag.append(icon);
                anchorTag.append(content);
                listItem.append(anchorTag);
                notificationList.append(listItem);
            });

            // setupPagination(response.length);

            $(".notifications-count").text(unreadCount);
        } else {
            $(".notifications-count").text(unreadCount);
            notificationList.append(
                '<li><div class="text-center d-flex py-2"><div class="flex-grow-1 pe-2"><div class="fw-semibold">Tidak Ada Notifikasi Baru</div></div></div></li>'
            );
        }
    } catch (error) {
        console.error(error);
    }
};

const markNotificationAsRead = async (notificationId, anchorTag) => {
    try {
        await $.ajax({
            url: "/notifications/update/" + notificationId,
            type: "POST",
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
        });

        loadNotification();
        // window.location.reload();
        One.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-bell me-1",
            message: "Tidak ada notifikasi baru, Terimakasih",
        });
    } catch (error) {
        console.error(error);
    }
};

// const setupPagination = (totalNotifications) => {
//     const totalPages = Math.ceil(totalNotifications / itemsPerPage);
//     const paginationContainer = $("#pagination");

//     paginationContainer.empty();

//     for (let page = 1; page <= totalPages; page++) {
//         const pageLink = $(`<a href="javascript:void(0)">${page}</a>`);

//         pageLink.click(async function () {
//             currentPage = page;
//             await loadNotification();
//         });

//         paginationContainer.append(pageLink);
//     }
// };

const alertNotification = async (notificationMessage) => {
    One.helpers("jq-notify", {
        type: "success",
        icon: "fa fa-bell me-1",
        message: notificationMessage,
    });
};
