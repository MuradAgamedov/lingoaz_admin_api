    <!-- Topbar Start -->
            <div class="app-header min-h-topbar-height flex items-center sticky top-0 z-30 bg-(--topbar-background) border-b border-default-200">
                <div class="w-full flex items-center justify-between px-6">
                    <div class="flex items-center gap-5">
                        <!-- Sidenav Menu Toggle Button -->
                        <button id="button-toggle-menu" class="btn btn-icon size-9 bg-default-400/10 hover:bg-default-150 rounded">
                            <i class="iconify lucide--align-left text-xl"></i>
                        </button>

                        <!-- Topbar Search -->
                        <div class="lg:flex hidden items-center relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <i class="iconify tabler--search text-base"></i>
                            </div>

                            <input type="search" id="topbar-search" class="form-input px-12 text-sm rounded border-transparent focus:border-transparent w-60" placeholder="Search something...">

                            <button type="button" class="absolute inset-y-0 end-0 flex items-center pe-4">
                                <span class="ms-auto font-medium">⌘ K</span>
                            </button>
                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <!-- Language Dropdown Button -->
                        <div class="topbar-item hs-dropdown [--placement:bottom-right] relative inline-flex">
                            <button class="hs-dropdown-toggle btn btn-icon size-8 hover:bg-default-150 rounded-full relative" type="button" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHB8fHx8fHx8fHx//2wBDAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAqAEADAREAAhEBAxEB/8QAGwABAAIDAQEAAAAAAAAAAAAAAAMHAgQFBgH/xAA3EAAABAEHCQcEAwEAAAAAAAABAgMEAAUGBxESExYUFTFVVpKh0dMhIjIzQZGTI0JR0iVFYYL/xAAbAQEAAgMBAQAAAAAAAAAAAAAAAgYBBAUDB//EADIRAAACAxACAgEFAAAAAAAAAAABAgPwBAUREhMUFSExUVJTVIGCoUFxMpHRIkJDYeH/2gAMAwEAAhEDEQA/APLDJaK0nN3RxUaLKJuFjuXQjdOjJnAATbCUgiJ+3ttDpi1xoDgtss8exrDdGb7POxksnd2AUMnmb+yAAQvL0Qu7Fi1wiMocXx78WhANZvIbQzUwmWFW3kg5xStC1a5QIgcjqsloDBV9sSNYcP3V5P0A7M0JGkfEEkpSgquyaOE3V/KIiFwtdCcCGbiJAGz3QAa/WOc+kCShKMdVXsh03nXLVboRNUjGTrqvqFm4Xo32iU9y/pFUklWIXOknxyC7/IYXo32iU9y/pCSVYgpJ8cgu/wAhhejfaJT3L+kJJViCknxyC7/I+lmzRyUwGLONQDANYCAlAQEP+ISSrEMG+L4n/ATbinmhQQkZFU4ZKDhq7IVd2ALpOBBQoWGxLA3KgaLden1CL0lWlfWVnj3ePnQ6Qtv5AZPyZe9Byc+abRc5FDJK7zLLuoU/Wxw9Y84aoYfFv7bbgEDcxDppOwUIoRsWTinfopARq2G0PdeN7v65gq8XrV6xI7r41Xk/R+AG9No8kNJxSO8lZis4k5Ur0xjJmC4X7yhSnbJfSuilNpLXGi+SSJKEo1Zfpq8+LR03nVrk3QiSk4qdcB7ejFj4hor1E49g60VWUU4W+xc5g+mci3EMQ0V6icewdaEopwt9hMH0zkW4hiGivUTj2DrQlFOFvsJg+mci3EMQ0V6icewdaEopwt9hMH0zkW4itCTLn80albtJuPEXBk1m75eyKpVk1DAIAUogJSVAFVoo9sXWcKjOE0i/ofO4hicZqTzFwKWFHuZr0Vyyd37YKCld2sos3mnvVaIjLq4PmUa//AiHcME5r0igUqys3nikotgblk92CdkESthEQKZMC2Fa+ztNxjJr1OIoK4dwiJDrzQkGe8lziYSsE13AOm5XAu1FQNdrHXtVGAlQASoDVVFjTfB0IyJkicY6oCG89znQTXESxKIhXCYsrFE/dmC7h+cVyVWYRZKNcOo7IMUT92YLuH5wlVmEKNcOo7IMUT92YLuH5wlVmEKNcOo7IMUT92YLuH5wlVmEKNcOo7IZ5kpZ1014dCERdeTbCM8erKTbmGZKWddNeHQhEXXk2wTx6spNuYZkpZ1014dCERdeTbBPHqyk25hmSlnXTXh0IRF15NsE8erKTbmGZKWddNeHQhEXXk2wTx6spNuYZkpZ1014dCERdeTbBPHqyk25hmSlnXTXh0IRF15NsE8erKTbmGZKWddNeHQhEXXk2wTx6spNuY4+F5nbWj8hOceckhiHQpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abox4Jx56nl+I3l+DT9v8An4jTMWlD4lbvaI92MCQbsADdgAbsADdgAbsAEjfz0/L8RfM8Gn7v8/MZIRT+J27Wj//Z" alt="" class="size-4.5 rounded">
                            </button>

                            <div class="hs-dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
                                <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="#">
                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHB8fHx8fHx8fHx//2wBDAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAqAEADAREAAhEBAxEB/8QAGwABAAIDAQEAAAAAAAAAAAAAAAMHAgQFBgH/xAA3EAAABAEHCQcEAwEAAAAAAAABAgMEAAUGBxESExYUFTFVVpKh0dMhIjIzQZGTI0JR0iVFYYL/xAAbAQEAAgMBAQAAAAAAAAAAAAAAAgYBBAUDB//EADIRAAACAxACAgEFAAAAAAAAAAABAgPwBAUREhMUFSExUVJTVIGCoUFxMpHRIkJDYeH/2gAMAwEAAhEDEQA/APLDJaK0nN3RxUaLKJuFjuXQjdOjJnAATbCUgiJ+3ttDpi1xoDgtss8exrDdGb7POxksnd2AUMnmb+yAAQvL0Qu7Fi1wiMocXx78WhANZvIbQzUwmWFW3kg5xStC1a5QIgcjqsloDBV9sSNYcP3V5P0A7M0JGkfEEkpSgquyaOE3V/KIiFwtdCcCGbiJAGz3QAa/WOc+kCShKMdVXsh03nXLVboRNUjGTrqvqFm4Xo32iU9y/pFUklWIXOknxyC7/IYXo32iU9y/pCSVYgpJ8cgu/wAhhejfaJT3L+kJJViCknxyC7/I+lmzRyUwGLONQDANYCAlAQEP+ISSrEMG+L4n/ATbinmhQQkZFU4ZKDhq7IVd2ALpOBBQoWGxLA3KgaLden1CL0lWlfWVnj3ePnQ6Qtv5AZPyZe9Byc+abRc5FDJK7zLLuoU/Wxw9Y84aoYfFv7bbgEDcxDppOwUIoRsWTinfopARq2G0PdeN7v65gq8XrV6xI7r41Xk/R+AG9No8kNJxSO8lZis4k5Ur0xjJmC4X7yhSnbJfSuilNpLXGi+SSJKEo1Zfpq8+LR03nVrk3QiSk4qdcB7ejFj4hor1E49g60VWUU4W+xc5g+mci3EMQ0V6icewdaEopwt9hMH0zkW4hiGivUTj2DrQlFOFvsJg+mci3EMQ0V6icewdaEopwt9hMH0zkW4itCTLn80albtJuPEXBk1m75eyKpVk1DAIAUogJSVAFVoo9sXWcKjOE0i/ofO4hicZqTzFwKWFHuZr0Vyyd37YKCld2sos3mnvVaIjLq4PmUa//AiHcME5r0igUqys3nikotgblk92CdkESthEQKZMC2Fa+ztNxjJr1OIoK4dwiJDrzQkGe8lziYSsE13AOm5XAu1FQNdrHXtVGAlQASoDVVFjTfB0IyJkicY6oCG89znQTXESxKIhXCYsrFE/dmC7h+cVyVWYRZKNcOo7IMUT92YLuH5wlVmEKNcOo7IMUT92YLuH5wlVmEKNcOo7IMUT92YLuH5wlVmEKNcOo7IZ5kpZ1014dCERdeTbCM8erKTbmGZKWddNeHQhEXXk2wTx6spNuYZkpZ1014dCERdeTbBPHqyk25hmSlnXTXh0IRF15NsE8erKTbmGZKWddNeHQhEXXk2wTx6spNuYZkpZ1014dCERdeTbBPHqyk25hmSlnXTXh0IRF15NsE8erKTbmGZKWddNeHQhEXXk2wTx6spNuY4+F5nbWj8hOceckhiHQpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abowwvM7a0fkJzhJIYgpJ2abox4Jx56nl+I3l+DT9v8An4jTMWlD4lbvaI92MCQbsADdgAbsADdgAbsAEjfz0/L8RfM8Gn7v8/MZIRT+J27Wj//Z" alt="" class="size-4 rounded-full">
                                    English
                                </a>
                                <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="#">
                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHB8fHx8fHx8fHx//2wBDAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAqAEADAREAAhEBAxEB/8QAGwABAAIDAQEAAAAAAAAAAAAAAAQFAQMHAgb/xAAxEAABAwEGAwUIAwAAAAAAAAABAgMEAAUGERJVkxZR0RUyM5LSExQiMTRBQmJhcZH/xAAbAQEAAgMBAQAAAAAAAAAAAAAAAgYDBAUBB//EAC0RAAIBAQYFAwMFAAAAAAAAAAABAgMRExQxUpEEEiFBUSJxoTJhgQWxwdHw/9oADAMBAAIRAxEAPwCkU44tRUpRUpRxUokkkn7muWfTEjGZXM0AzK5mgGZXM0AzK5mgGZXM0AzK5mgMpccQoKSopUk4pUCQQR9xQNHeOwLC06Lst+mqPiauqW7K7fT8vc8rsW7bTa3ZEOGww0lS3HVsthKUpGJJ+Gs3DzrVZqKm1b92eOtU7OTZWQJdxJs9cJuI0y7nyMLkQw0hxWOXLmKfhOcEAKw5fOunPgqlj5ar3z6e/wDkTnfxipPLvZK2wtewLC06Lst+muNiauqW7I30/L3HYFhadF2W/TTE1dUt2L6fl7jsCwtOi7LfppiauqW7F9Py9x2BYWnRdlv00xNXVLdi+n5e47AsLTouy36aYmrqluxfT8vcn1gMZ8veF8QkFMWJLie9voVaMlXu7iS2oFGZKG1POAKCRhmb/wAqwLhYqEJW2vktSfn7ZfLNjhvW+ri+XLP+bFszNxrTuq4p9qQuL73FlqBelZY6xHKQEFJIZBVmCsRhiKsFD9LhcRlWj9a1P+zR4rinOpKFNy9KySt9XyXMERVyHpbUKQw7IOWQ+6uOptZaOVASGnHFAhJ/ICqrx3DqnRptO3rL2z7dLfe38Gbml9LaaXvb191+xOrkgUAoBQCgKSREctGG9CFlpsrMQtUkeyV7VYcCiVhtRUSeZrt1+JppU7JqXKrOilv1SRHh6s1NuSl+WvghP3FQiOlMaW0VvtluaS0oHEqcwWjAjMcruHxfcA/xWatx1Hkj6pSce3bt5yyNilxVkm3Czb5LmKsmXk7ITF9mlSDaGLRW6kKGUKyEr/rGtTi6sJUIRU4uUeyUrevXurOmWZpwlPmdttnurPx17k+uSZhQCgFAcK4ovHqcreX1q7YOjojsWG4p6UOKLx6nK3l9aYOjojsLinpQ4ovHqcreX1pg6OiOwuKelDii8epyt5fWmDo6I7C4p6UOKLx6nK3l9aYOjojsLinpQ4ovHqcreX1pg6OiOwuKelDii8epyt5fWmDo6I7C4p6UOKLx6nK3l9aYOjojsLinpRDk/Uu+F31eF3Pn+H68q2mSjkszX5a8JDy0A8tAPLQDy0A8tAbI31LXhd9Pi9z5/n+vOvURlk8z/9k=" alt="" class="size-4 rounded-full">
                                    Spanish
                                </a>
                                <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="#">
                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHB8fHx8fHx8fHx//2wBDAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAqAEADAREAAhEBAxEB/8QAGQABAQEAAwAAAAAAAAAAAAAAAAEGAgUH/8QAKBAAAQIBDQADAQAAAAAAAAAAAAECAwUSFhcxUVRVkaKj0uMhMkGB/8QAGgEBAAIDAQAAAAAAAAAAAAAAAAEFAgQGB//EACQRAQAAAgoDAQAAAAAAAAAAAAAWYgIDBBQVUVKhouEBsdEx/9oADAMBAAIRAxEAPwDzZ8WK97nve5z3Kqucqqqqq/KqqqbCEnOvUkJzr1ATnXqAnOvUBOdeoCc69QKyLFY9r2Pc17VRWuRVRUVPlFRUIHZUZlvDb4fY1r5VZ+1zD1t0cqP0ozLeG3w+wvlVn7IetujlR+lGZbw2+H2F8qs/ZD1t0cqP0ozLeG3w+wvlVn7IetujlR+lGZbw2+H2F8qs/ZD1t0cqP0ozLeG3w+wvlVn7IetujlR+lGZbw2+H2F8qs/ZD1t0cqP0ozLeG3w+wvlVn7IetujlR+t0Ub04AAAAAAAA3dV6ZnwehSYxJv05uIZOXRVemZ8HoMYk36Ihk5dFV6ZnwegxiTfoiGTl0VXpmfB6DGJN+iIZOXRVemZ8HoMYk36Ihk5dFV6ZnwegxiTfoiGTl0VXpmfB6DGJN+iIZOXRVemZ8HoMYk36Ihk5dN2UjmwAAAAAAADk77LZb+Wfwzp/vn8R4TQxDQBoA0AaANAK37JZb+2f0yofvj8PL/9k=" alt="" class="size-4 rounded-full">
                                    German
                                </a>
                                <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="#">

                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHB8fHx8fHx8fHx//2wBDAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAqAEADAREAAhEBAxEB/8QAGgAAAwEBAQEAAAAAAAAAAAAAAAYHCAMBAv/EAC8QAAEDAQUGAwkAAAAAAAAAAAABAgM2BwgxM3QRMjRRsbMERJIGEhYhQmFicXP/xAAbAQACAwEBAQAAAAAAAAAAAAAABwMFBgQBAv/EACIRAQAAAwkBAQAAAAAAAAAAAAABMTIDBAUGMzSBgsERAv/aAAwDAQACEQMRAD8AQHyyPe573q57lVXOVVVVVcVVTY/HI+fedzUApt3tVX27m2r5CbuRldielyks5tIGfTgAjVrKr8VJ8/LR9XFZe6zEyxte0fCXtXmcrRfHrXva5HNcrXNXaiouxUVAeRhCKcjOI8AFOu913NoJu5GV2KaXKSzm0gZ9OACM2s1Wmmj6uKy91mJlja9o+Ew5WiABOhnEcACnXe67m0E3cjK7FNLlJZzaQM+nABGbWarTTR9XFZe6zEyxte0fCYcrRAAnQziOABTrvddzaCbuRldimlyks5tIGfTgAjNrNVppo+risvdZiZY2vaPhMOVogAToZxHAAp13uu5tBN3IyuxTS5SWc2kDPpwARm1mq000fVxWXusxMsbXtHwmHK0QAEPxfFTZO+7Ky8V3Px5DMhIjnL0HoUy77XUu7wM2H9IyuxPS5SWc2jygTgAjVrFVJhw0eP7cVl7rMPLG17R8JnpOVoXTw+fHl7zczcx+r7cz2D5/dMZ8Tf/Z" alt="" class="size-4 rounded-full">
                                    French
                                </a>
                                <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="#">
                                    <img src="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20id='flag-icons-jp'%20viewBox='0%200%20512%20512'%3e%3cdefs%3e%3cclipPath%20id='a'%3e%3cpath%20fill-opacity='.7'%20d='M177.2%200h708.6v708.7H177.2z'/%3e%3c/clipPath%3e%3c/defs%3e%3cg%20fill-rule='evenodd'%20stroke-width='1pt'%20clip-path='url(%23a)'%20transform='translate(-128)%20scale(.72249)'%3e%3cpath%20fill='%23fff'%20d='M0%200h1063v708.7H0z'/%3e%3ccircle%20cx='523.1'%20cy='344.1'%20r='194.9'%20fill='%23d30000'%20transform='translate(-59.7%20-34.5)%20scale(1.1302)'/%3e%3c/g%3e%3c/svg%3e" alt="" class="size-4 rounded-full">
                                    Japanese
                                </a>
                                <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="#">
                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHB8fHx8fHx8fHx//2wBDAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAqAEADAREAAhEBAxEB/8QAGgAAAwEBAQEAAAAAAAAAAAAAAAYHBAECA//EACsQAAEDAQYEBgMAAAAAAAAAAAABAgMHETEzNnSxFjJRsiE0QkRhkgRxcv/EABsBAAIDAQEBAAAAAAAAAAAAAAAGBAUHAwEC/8QAIREBAAEDBQEBAQEAAAAAAAAAAAEGMjQDBHKCwTECEYH/2gAMAwEAAhEDEQA/ANznvc5XOcquVbVVVtVVUyeZmVa5avUAcqUqvE0nj7WTvYX9OZE8Z8dtC5XR5TAARqrKrxUnj7aPdxWbu9olMYvafCXavUimL+Ote9rkc1ytc1bUVFsVFQHkxEtAiMIAA50pzNJpZO9hfU5kTxnx20LldHpMABGas5rTTR7uKzd3tEpjF7T4TCKYgAaREYOABzpTmaTSyd7C+pzInjPjtoXK6PSYACM1ZzWmmj3cVm7vaJTGL2nwmEUxAA0iIwcADnSnM0mlk72F9TmRPGfHbQuV0ekwAEZqzmtNNHu4rN3e0SmMXtPhMIpiABpERg4AHOlOZpNLJ3sL6nMieM+O2hcro9JgAIzVnNaaaPdxWbu9olMYvafCYRTEADfPjyYfMuHyX+n46CP+/s/GDy8fU+QcaVZmku8tJd/TC+pzInjPjtoXK6PKYACNVYzUl3lo7/24rN3e0OmMXtPhM+pFML6fj48eHzNxOS/1fHU9h8/u2fv+fX//2Q==" alt="" class="size-4 rounded-full">
                                    Italian
                                </a>
                                <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="#">
                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHB8fHx8fHx8fHx//2wBDAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAqAEADAREAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAMGCP/EACgQAAEABwcFAQAAAAAAAAAAAAABBAcWF1RVMjOSo6TT4gIDMUJRYf/EABkBAQADAQEAAAAAAAAAAAAAAAABAgYEA//EACMRAQAABAcBAAMAAAAAAAAAAAABFmOiAxMVUqHR4jECMoH/2gAMAwEAAhEDEQA/AOnAAAAAAAAAGIjUzOs6Za2js0/G28w7UzIEamZ1nTLW0NPxtvMOzMgRqZnWdMtbQ0/G28w7MyBGpmdZ0y1tDT8bbzDszIEamZ1nTLW0NPxtvMOzMgRqZnWdMtbQ0/G28w7MyBGpmdZ0y1tDT8bbzDszIEamZ1nTLW0NPxtvMOzMg5YNK5wAAAAAAADRuiiay+RmJjp3eW4kyrZ6HRRNZfITHTu8kmVbPQ6KJrL5CY6d3kkyrZ6HRRNZfITHTu8kmVbPQ6KJrL5CY6d3kkyrZ6HRRNZfITHTu8kmVbPQ6KJrL5CY6d3kkyrZ6HRRNZfITHTu8kmVbPTRGYbkAAAAAAAAssX/AHLu11Xdjz6/nwmLz/D9Yff79TwkLGEBhAYQGEBhAor3/bu7XTeWPPt+fSYK/n+sfv8APr//2Q==" alt="" class="size-4 rounded-full">
                                    Russian
                                </a>
                                <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="#">
                                    <img src="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20id='flag-icons-ae'%20viewBox='0%200%20512%20512'%3e%3cpath%20fill='%2300732f'%20d='M0%200h512v170.7H0z'/%3e%3cpath%20fill='%23fff'%20d='M0%20170.7h512v170.6H0z'/%3e%3cpath%20d='M0%20341.3h512V512H0z'/%3e%3cpath%20fill='red'%20d='M0%200h180v512H0z'/%3e%3c/svg%3e" alt="" class="size-4 rounded-full">
                                    Arabic
                                </a>
                            </div>
                        </div>

                        <!-- Light/Dark Mode Button -->
                        <div class="topbar-item">
                            <button class="btn btn-icon size-8 hover:bg-default-150 transition-[scale] rounded-full" id="light-dark-mode" type="button">
                                <i class="iconify tabler--moon text-xl absolute dark:scale-0 dark:-rotate-90 scale-100 rotate-0 transition-all duration-200"></i>
                                <i class="iconify tabler--sun text-xl absolute dark:scale-100 dark:rotate-0 scale-0 rotate-90 transition-all duration-200"></i>
                            </button>
                        </div>

                        <!-- Notification Button -->
                        <div class="topbar-item hs-dropdown [--auto-close:inside] relative inline-flex">
                            <button type="button" class="hs-dropdown-toggle btn btn-icon size-8 hover:bg-default-150 rounded-full relative" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <i data-lucide="bell-ring" class="size-4.5"></i>
                                <span class="absolute end-0 top-0 size-1.5 bg-primary/90 rounded-full"></span>
                            </button>

                            <div class="hs-dropdown-menu max-w-100 p-0" role="menu">
                                <!-- Header -->
                                <div class="p-4 border-b border-default-200">
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-base text-default-800">Notifications</h3>
                                        <span class="size-5 font-semibold bg-orange-500 rounded text-white flex items-center justify-center text-xs">15</span>
                                    </div>
                                </div>

                                <!-- Tabs -->
                                <nav class="flex gap-x-1 bg-default-150 p-2 border-b border-default-200" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                                    <button data-hs-tab="#tabsViewall" type="button" class="hs-tab-active:bg-card hs-tab-active:text-primary py-0.5 px-4 rounded font-semibold inline-flex items-center gap-x-2 border-b-2 border-transparent text-xs whitespace-nowrap text-default-500 active" aria-selected="true" aria-controls="tabsViewall" role="tab">
                                        View all
                                    </button>
                                    <button data-hs-tab="#tabsMentions" type="button" class="hs-tab-active:bg-card hs-tab-active:text-primary py-0.5 px-4 rounded font-semibold inline-flex items-center gap-x-2 border-b-2 border-transparent text-xs whitespace-nowrap text-default-500" aria-selected="false" aria-controls="tabsMentions" role="tab">
                                        Mentions
                                    </button>
                                    <button data-hs-tab="#tabsFollowers" type="button" class="hs-tab-active:bg-card hs-tab-active:text-primary py-0.5 px-4 rounded font-semibold inline-flex items-center gap-x-2 border-b-2 border-transparent text-xs whitespace-nowrap text-default-500" aria-selected="false" aria-controls="tabsFollowers" role="tab">
                                        Followers
                                    </button>
                                    <button data-hs-tab="#tabsInvites" type="button" class="hs-tab-active:bg-card hs-tab-active:text-primary py-0.5 px-4 rounded font-semibold inline-flex items-center gap-x-2 border-b-2 border-transparent text-xs whitespace-nowrap text-default-500" aria-selected="false" aria-controls="tabsInvites" role="tab">
                                        Invites
                                    </button>
                                </nav>

                                <!-- Tabs content -->
                                <div class="h-80" data-simplebar>
                                    <!-- View all -->
                                    <div id="tabsViewall" role="tabpanel" aria-labelledby="tabsViewall-item">
                                        <a href="#" class="flex gap-3 p-4 items-center hover:bg-default-150">
                                            <div>
                                                <div class="size-10 rounded-md  bg-default-100">
                                                    <img src="{{ asset('assets/avatar-3-CuoB696V.png') }}" alt="" class="rounded-md">
                                                </div>
                                            </div>

                                            <div class="flex justify-between w-full text-sm">
                                                <div>
                                                    <h6 class="mb-2 font-medium text-default-800"><b>@willie_passem</b> followed you</h6>
                                                    <p class="flex items-center gap-1 text-default-500 text-xs">
                                                        <i data-lucide="clock" class="align-middle size-3.5"></i>
                                                        <span>Wednesday 03:42 PM</span>
                                                    </p>
                                                </div>

                                                <div>
                                                    <div class="flex items-center  gap-2 text-xs text-default-500">
                                                        <div class="size-1.5 bg-primary rounded-full"></div>4 sec
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" class="flex gap-3 p-4 items-start hover:bg-default-150">
                                            <div>
                                                <div class="size-10 rounded-md  bg-warning/10">
                                                    <img src="{{ asset('assets/avatar-5-ACaGxkSo.png') }}" alt="" class="rounded-md">
                                                </div>
                                            </div>

                                            <div class="flex justify-between w-full">
                                                <div class="text-sm">
                                                    <h6 class="mb-2 font-medium text-default-800"><b>@caroline_jessica</b> commented <br>on your post</h6>
                                                    <p class="flex items-center gap-1 text-default-500 text-xs">
                                                        <i data-lucide="clock" class="align-middle size-3.5"></i>
                                                        <span>Wednesday 03:42 PM</span>
                                                    </p>

                                                    <p class="p-2  bg-default-50 text-default-500 mt-2 rounded">
                                                        Amazing! Fast, to the point, professional and really amazing to work
                                                        with them!!!
                                                    </p>
                                                </div>

                                                <div>
                                                    <div class="flex items-center gap-2 text-xs text-default-500">
                                                        <div>
                                                            <div class="size-1.5 bg-primary rounded-full"></div>
                                                        </div>15 min
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" class="flex gap-3 p-4 items-start hover:bg-default-150">
                                            <div>
                                                <div class="size-10 rounded-md  bg-red-100 flex justify-center items-center">
                                                    <i data-lucide="shopping-bag" class="size-5 text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="flex justify-between gap-2 w-full">
                                                <div>
                                                    <h6 class="mb-1 font-medium text-default-800 text-sm">Successfully purchased a business plan for
                                                        <span class="text-danger">$199.99</span>
                                                    </h6>
                                                    <p class="flex items-center gap-1 text-default-500 text-xs">
                                                        <i data-lucide="clock" class="align-middle size-3.5"></i>
                                                        <span>Monday 11:26 AM</span>
                                                    </p>
                                                </div>

                                                <div>
                                                    <div class="flex items-center  gap-2 text-xs text-default-500">
                                                        <div class="size-1.5 bg-primary rounded-full"></div>yesterday
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" class="flex gap-3 p-4 items-center hover:bg-default-150">
                                            <div class="relative">
                                                <div class="size-10 rounded-md  bg-pink-100">
                                                    <img src="{{ asset('assets/avatar-7-QY-kCwjM.png') }}" alt="" class="rounded-md">
                                                </div>
                                                <div class="absolute text-orange-500 bottom-0 -end-0.5 text-base">
                                                    <i data-lucide="heart" class="size-3.5 fill-orange-500"></i>
                                                </div>
                                            </div>

                                            <div class="flex justify-between w-full">
                                                <div>
                                                    <h6 class="mb-1 font-medium text-default-800  text-sm"><b>@scott</b> liked your post</h6>
                                                    <p class="flex gap-1 items-center text-default-500 text-xs">
                                                        <i data-lucide="clock" class="align-middle size-3.5"></i><span>Thursday 06:59 AM</span>
                                                    </p>
                                                </div>

                                                <div>
                                                    <div class="flex items-center gap-2 text-xs text-default-500">
                                                        <div class="size-1.5 bg-primary rounded-full"></div>1 Week
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Mentions -->
                                    <div id="tabsMentions" class="hidden" role="tabpanel" aria-labelledby="tabsMentions-item">
                                        <a href="#" class="flex gap-3 p-4 items-start hover:bg-default-150">
                                            <div>
                                                <div class="size-10 rounded-md  bg-warning/10">
                                                    <img src="{{ asset('assets/avatar-5-ACaGxkSo.png') }}" alt="" class="rounded-md">
                                                </div>
                                            </div>

                                            <div class="flex justify-between w-full">
                                                <div class="text-sm">
                                                    <h6 class="mb-2 font-medium text-default-800"><b>@caroline_jessica</b> commented <br>on your post</h6>
                                                    <p class="flex items-center gap-1 text-default-500 text-xs">
                                                        <i data-lucide="clock" class="align-middle size-3.5"></i>
                                                        <span>Wednesday 03:42 PM</span>
                                                    </p>

                                                    <p class="p-2  bg-default-50 text-default-500 mt-2 rounded">
                                                        Amazing! Fast, to the point, professional and really amazing to work
                                                        with them!!!
                                                    </p>
                                                </div>

                                                <div>
                                                    <div class="flex items-center gap-2 text-xs text-default-500">
                                                        <div class="size-1.5 bg-primary rounded-full"></div>15 min
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" class="flex gap-3 p-4 items-center hover:bg-default-150">
                                            <div class="relative">
                                                <div class="size-10 rounded-md  bg-pink-100">
                                                    <img src="{{ asset('assets/avatar-7-QY-kCwjM.png') }}" alt="" class="rounded-md">
                                                </div>
                                                <div class="absolute text-orange-500 bottom-0 -end-0.5 text-base">
                                                    <i data-lucide="heart" class="size-3.5 fill-orange-500"></i>
                                                </div>
                                            </div>

                                            <div class="flex justify-between w-full">
                                                <div>
                                                    <h6 class="mb-1 font-medium text-default-800  text-sm"><b>@scott</b> liked your post</h6>
                                                    <p class="flex gap-1 items-center text-default-500 text-xs">
                                                        <i data-lucide="clock" class="align-middle size-3.5"></i><span>Thursday 06:59 AM</span>
                                                    </p>
                                                </div>

                                                <div>
                                                    <div class="flex items-center gap-2 text-xs text-default-500">
                                                        <div class="size-1.5 bg-primary rounded-full"></div>1 Week
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Followers -->
                                    <div id="tabsFollowers" class="hidden" role="tabpanel" aria-labelledby="tabsFollowers-item">
                                        <a href="#" class="flex gap-3 p-4 items-center hover:bg-default-150">
                                            <div>
                                                <div class="size-10 rounded-md  bg-default-100">
                                                    <img src="{{ asset('assets/avatar-3-CuoB696V.png') }}" alt="" class="rounded-md">
                                                </div>
                                            </div>

                                            <div class="flex justify-between w-full text-sm">
                                                <div>
                                                    <h6 class="mb-2 font-medium text-default-800"><b>@willie_passem</b> followed you</h6>
                                                    <p class="flex items-center gap-1 text-default-500 text-xs">
                                                        <i data-lucide="clock" class="align-middle size-3.5"></i>
                                                        <span>Wednesday 03:42 PM</span>
                                                    </p>
                                                </div>

                                                <div>
                                                    <div class="flex items-center  gap-2 text-xs text-default-500">
                                                        <div class="size-1.5 bg-primary rounded-full"></div>4 sec
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Invites -->
                                    <div id="tabsInvites" class="hidden" role="tabpanel" aria-labelledby="tabsInvites-item">
                                        <a href="#" class="flex gap-3 p-4 items-start hover:bg-default-150">
                                            <div>
                                                <div class="size-10 rounded-md  bg-red-100 flex justify-center items-center">
                                                    <i data-lucide="shopping-bag" class="size-5 text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="flex justify-between gap-2 w-full">
                                                <div>
                                                    <h6 class="mb-1 font-medium text-default-800 text-sm">Successfully purchased a business plan for
                                                        <span class="text-danger">$199.99</span>
                                                    </h6>
                                                    <p class="flex items-center gap-1 text-default-500 text-xs">
                                                        <i data-lucide="clock" class="align-middle size-3.5"></i>
                                                        <span>Monday 11:26 AM</span>
                                                    </p>
                                                </div>

                                                <div>
                                                    <div class="flex items-center  gap-2 text-xs text-default-500">
                                                        <div class="size-1.5 bg-primary rounded-full"></div>yesterday
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="flex items-center justify-between p-4 border-t border-default-200">
                                    <a href="#!" class="text-sm font-medium text-default-900">Manage Notification</a>
                                    <button type="button" class="btn btn-sm text-white bg-primary">
                                        View All
                                        <i data-lucide="move-right" class="size-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Setting Offcanvas Button -->
                        <div class="topbar-item">
                            <button class="btn btn-icon size-8 hover:bg-default-150 rounded-full" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="theme-customization" data-hs-overlay="#theme-customization">
                                <i data-lucide="settings" class="size-4.5"></i>
                            </button>
                        </div>

                        <!-- Profile Dropdown Button -->
                        <div class="topbar-item hs-dropdown relative inline-flex">
                            <button class="cursor-pointer bg-pink-100 rounded-full" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <img src="{{ asset('assets/avatar-1-DOkfBXSU.png') }}" alt="user-image" class="hs-dropdown-toggle rounded-full size-9.5">
                            </button>

                            <div class="hs-dropdown-menu min-w-48" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                <div class="p-2">
                                    <h6 class="mb-2 text-default-500">Welcome to Tailwick</h6>

                                    <a href="#!" class="flex gap-3">
                                        <div class="relative inline-block">
                                            <div class="rounded bg-default-200">
                                                <img src="{{ asset('assets/avatar-1-DOkfBXSU.png') }}" alt="" class="size-12 rounded">
                                            </div>
                                            <span class="-top-1 -end-1 absolute size-2.5 bg-green-400 border-2 border-white rounded-full"></span>
                                        </div>

                                        <div>
                                            <h6 class="mb-1 text-sm font-semibold text-default-800">Paula Keenan</h6>
                                            <p class="text-default-500">CEO & Founder</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="border-t border-t-default-200 -mx-2 my-2"></div>

                                <div class="flex flex-col gap-y-1">
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="apps-mailbox.html">
                                        <i data-lucide="mail" class="size-4"></i>
                                        Inbox
                                        <span class="size-4.5 font-semibold bg-danger rounded text-white flex items-center justify-center text-xs">15</span>
                                    </a>

                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="apps-chat.html">
                                        <i data-lucide="messages-square" class="size-4"></i>
                                        Chat
                                    </a>

                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="pages-pricing.html">
                                        <i data-lucide="gem" class="size-4"></i>
                                        Upgrade Pro
                                    </a>

                                    <div class="border-t border-default-200 -mx-2 my-1"></div>

                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded" href="auth-basic-logout.html">
                                        <i data-lucide="log-out" class="size-4"></i>
                                        Sign Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Topbar End -->
