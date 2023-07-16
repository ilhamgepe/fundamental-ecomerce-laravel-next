export interface RootPost {
  data: Data;
}

export interface Data {
  current_page: number;
  data: Post[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: Link[];
  next_page_url: string;
  path: string;
  per_page: number;
  prev_page_url: any;
  to: number;
  total: number;
}

export interface Post {
  id: number;
  image: string;
  title: string;
  description: string;
  created_at: string;
  updated_at: string;
  categories: Category[];
}
export interface Category {
  id: number;
  name: string;
  created_at: string;
  updated_at: string;
  pivot: Pivot;
}

export interface Pivot {
  post_id: number;
  category_id: number;
  created_at: string;
  updated_at: string;
}

export interface Link {
  url?: string;
  label: string;
  active: boolean;
}