export interface Staff {
  id: number;
  name: string;
  role: 'server' | 'cook' | 'manager';
  phone: string;
  email: string;
  created_at: string;
  updated_at: string;
}

export interface CreateStaffData {
  name: string;
  role: 'server' | 'cook' | 'manager';
  phone: string;
  email: string;
} 