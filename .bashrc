eval "`dircolors -b`"
alias ls='ls --color=auto'
alias dir='ls --color=auto --format=vertical'
alias vdir='ls --color=auto --format=long' 
alias l=vdir
alias ll='ls -la --color=auto'

function encode() { echo -n $@ | perl -pe's/([^-_.~A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg'; }
function google() { chromium-browser http://www.google.com/search?hl=id#q="`encode $@`" ;}

alias g=google
alias home='cd ~/'
alias web='cd /var/www'
alias sub='sublime-text'

alias privbak="sh ~/.scripts/backup"
alias pi="php ~/.scripts/projectIniter/init.php"
alias phpunit='clear & phpunit --colors'

