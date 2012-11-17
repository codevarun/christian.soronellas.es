set :application, "christian.soronellas"
set :domain,      "#{application}.es"
set :deploy_to,   "/sites/#{domain}"
set :user,        "christian.soronellas.es"
set :app_path,    "app"

set :repository,  "git@github.com:theUniC/#{application}.git"
set :scm,         :git
set :deploy_via,  :rsync_with_remote_cache

set :model_manager, "doctrine"

role :web,        5.39.79.150
role :app,        5.39.79.150
role :db,         5.39.79.150, :primary => true

set  :keep_releases,  2

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   [app_path + "/logs", app_path + "/cache", web_path + "/uploads", "vendor"]
set :use_composer,      true
set :dump_assets,       true
set :interactive_mode,  false

# Task definitions
task :upload_parameters do
  origin_file = "app/config/parameters_prod.yml"
  destination_file = shared_path + "/app/config/parameters.yml"

  try_sudo "mkdir -p #{File.dirname(destination_file)}"
  top.upload(origin_file, destination_file)
end

namespace :christian_soronellas do
  task :install_javascript_components do
    run "cd #{current_path}/web; bower install"
  end
end

after "deploy", "christian_soronellas:install_javascript_components"
after "deploy:setup", "upload_parameters"