import { useState } from 'react';
import type { CreateShiftData } from '../types/Shift';
import { shiftService } from '../services/shiftService';
import { Button } from './ui/button';
import { Input } from './ui/input';
import { Label } from './ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from './ui/select';
import { Card, CardContent, CardHeader, CardTitle } from './ui/card';

interface CreateShiftFormProps {
  onShiftCreated: () => void;
}

export function CreateShiftForm({ onShiftCreated }: CreateShiftFormProps) {
  const [formData, setFormData] = useState<CreateShiftData>({
    day: '',
    start_time: '',
    end_time: '',
    role: 'server',
  });
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    
    try {
      await shiftService.createShift(formData);
      setFormData({ day: '', start_time: '', end_time: '', role: 'server' });
      onShiftCreated();
    } catch (error) {
      console.error('Error creating shift:', error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <Card>
      <CardHeader>
        <CardTitle>Create New Shift</CardTitle>
      </CardHeader>
      <CardContent>
        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <Label htmlFor="day">Date</Label>
            <Input
              id="day"
              type="date"
              value={formData.day}
              onChange={(e) => setFormData({ ...formData, day: e.target.value })}
              required
            />
          </div>
          
          <div>
            <Label htmlFor="start_time">Start Time</Label>
            <Input
              id="start_time"
              type="time"
              value={formData.start_time}
              onChange={(e) => setFormData({ ...formData, start_time: e.target.value })}
              required
            />
          </div>
          
          <div>
            <Label htmlFor="end_time">End Time</Label>
            <Input
              id="end_time"
              type="time"
              value={formData.end_time}
              onChange={(e) => setFormData({ ...formData, end_time: e.target.value })}
              required
            />
          </div>
          
          <div>
            <Label htmlFor="role">Role</Label>
            <Select value={formData.role} onValueChange={(value: any) => setFormData({ ...formData, role: value })}>
              <SelectTrigger>
                <SelectValue />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="server">Server</SelectItem>
                <SelectItem value="cook">Cook</SelectItem>
                <SelectItem value="manager">Manager</SelectItem>
              </SelectContent>
            </Select>
          </div>
          
          <Button type="submit" disabled={loading}>
            {loading ? 'Creating...' : 'Create Shift'}
          </Button>
        </form>
      </CardContent>
    </Card>
  );
} 