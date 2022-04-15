terraform {
  cloud {
    organization = "tharp-cloud"

    workspaces {
      name = "cloud"
    }
  }
}