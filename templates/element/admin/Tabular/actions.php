<?php
    $edit = '<a href="'.$this->request->getAttribute('webroot').$editLink.base64_encode($id).'" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <span class="svg-icon svg-icon-3">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3"
                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                    fill="currentColor"></path>
                <path
                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                    fill="currentColor"></path>
            </svg>
        </span>
    </a>';
    if (isset($deleteLink)) {
        $delete = '<a  sub-url="'.$deleteLink.base64_encode($id).'" data-kt-companies-table-filter="delete_row"  class="delete_row btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
            <span class="svg-icon svg-icon-3">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                        fill="currentColor"></path>
                    <path opacity="0.5"
                        d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                        fill="currentColor"></path>
                    <path opacity="0.5"
                        d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                        fill="currentColor"></path>
                </svg>
            </span>
    </a>';
    }
    $attachment = '<a data-attach-modal="'.base64_encode($id).'" data-bs-toggle="modal" data-bs-target="#upload-model" class="attach_for_upload_modal btn btn-icon btn-bg-light btn-active-color-primary btn-sm" href="#">
        <span class="svg-icon svg-icon-3">
            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" >
                    <rect x="0" y="0" width="24" height="24" />
                    <path
                        d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                    <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14"
                        rx="1" />
                    <path
                        d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
        </span>
    </a>';

    $actions = $edit;

    if (isset($deleteLink)) {
        $actions .= ' '.$delete;
    }

    if ($isAttachement) {
        $actions .= ' '.$attachment;
    }

    echo $actions;
?>
